<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NoticiaController extends Controller
{
    private const RULES = [
        'titulo' => 'required|string|max:200|min:2',
        'cuerpo' => 'required_without:archivo|nullable|string',
        'etiqueta' => 'nullable|string|max:200',
        'archivo' => 'required_without:cuerpo|nullable|file|mimes:txt,md|max:10240',
    ];

    private const MESSAGES = [
        'titulo.required' => 'El título es requerido',
        'titulo.string' => 'El título debe ser texto',
        'titulo.max' => 'El título debe tener máximo 200 caracteres',
        'titulo.min' => 'El título debe tener al menos 2 caracteres',
        'cuerpo.required_without' => 'El cuerpo es requerido si no se adjunta un archivo',
        'cuerpo.string' => 'El cuerpo debe ser texto',
        'etiqueta.string' => 'La etiqueta debe ser texto',
        'etiqueta.max' => 'La etiqueta debe tener máximo 200 caracteres',
        'archivo.required_without' => 'Debe ingresar el cuerpo o seleccionar un archivo',
        'archivo.file' => 'El archivo debe ser válido',
        'archivo.mimes' => 'El archivo debe ser de tipo txt o md',
        'archivo.max' => 'El archivo no debe superar los 10MB',
    ];
    /**
     * Display a listing of the resource.
     */
    
    public function gestion(): View
    {
        $noticias = Noticia::with('comentarios')->orderBy('created_at', 'desc')->get();
        return view('noticia.index', compact('noticias'));
    }

    /**
     * Buscar noticias por palabras clave, frases o títulos coincidentes.
     */
    public function search(Request $request): View
    {
        $query = trim((string) $request->input('search', $request->input('q', '')));

        if ($query !== '') {
            $words = array_values(array_filter(preg_split('/\s+/', $query), function ($word) {
                return mb_strlen(trim($word)) >= 2;
            }));

            $noticias = Noticia::with('comentarios')
                ->where(function ($q) use ($query, $words) {
                    // Coincidencia con frase completa
                    $q->where('titulo', 'LIKE', "%{$query}%")
                      ->orWhere('cuerpo', 'LIKE', "%{$query}%")
                      ->orWhere('etiqueta', 'LIKE', "%{$query}%");

                    // Coincidencias por palabras individuales
                    foreach ($words as $word) {
                        $q->orWhere('titulo', 'LIKE', "%{$word}%")
                          ->orWhere('cuerpo', 'LIKE', "%{$word}%")
                          ->orWhere('etiqueta', 'LIKE', "%{$word}%");
                    }
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $noticias = collect();
        }

        return view('search', [
            'noticias' => $noticias,
            'query' => $query,
            'search' => $query,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('noticia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1º Validar
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $noticia = new Noticia($request->all());

        // Si se seleccionó un archivo y no hay cuerpo, cargar contenido del archivo
        if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
            $noticia->cuerpo = file_get_contents($request->file('archivo')->getRealPath());
        }

        // Generar etiqueta a partir del título si no se especificó
        if (empty($noticia->etiqueta) && !empty($request->titulo)) {
            $noticia->etiqueta = Str::slug($request->titulo);
        }

        try {
            $noticia->save();
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'La noticia o etiqueta ya existe.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Ocurrió un error inesperado al guardar la noticia. Por favor, inténtelo de nuevo.',
            ]);
        }

        session(['success' => 'Noticia creada correctamente']);

        $redirectRoute = Route::has('noticia.create') ? 'noticia.create' : (Route::has('create') ? 'create' : 'index');

        return redirect()->route($redirectRoute)->with(['success' => 'Noticia creada correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia): View
    {
        return view('noticia.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia): View|RedirectResponse
    {
        if (!$noticia->puedeEditarse()) {
            return redirect()->route('noticia.show', $noticia)->withErrors([
                'error' => 'No se puede editar una noticia que lleva más de 20 minutos publicada.',
            ]);
        }

        return view('noticia.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia): RedirectResponse
    {
        if (!$noticia->puedeEditarse()) {
            return redirect()->route('noticia.show', $noticia)->withErrors([
                'error' => 'No se puede editar una noticia que lleva más de 20 minutos publicada.',
            ]);
        }

        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $noticia->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'La noticia o etiqueta ya existe. Error de clave única duplicada',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Ocurrió un error inesperado al actualizar la noticia. Por favor, inténtelo de nuevo.',
            ]);
        }

        return redirect()->route('noticia.edit', ['noticia' => $noticia])->with(['success' => 'Noticia modificada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia): RedirectResponse
    {
        if ($noticia->created_at && $noticia->created_at->lte(now()->subMinutes(20))) {
            return back()->withErrors([
                'error' => 'No se puede eliminar una noticia que lleva más de 20 minutos publicada.',
            ]);
        }

        if ($noticia->tieneComentarios()) {
            return back()->withErrors([
                'error' => 'No se puede eliminar una noticia que tiene comentarios.',
            ]);
        }

        try {
            $noticia->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors([
                'error' => 'Error al eliminar la noticia. No se puede completar la operación.',
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Ocurrió un error inesperado al eliminar la noticia. Por favor, inténtelo de nuevo.',
            ]);
        }

        return redirect()->route('noticia.index')->with(['success' => 'Noticia eliminada correctamente']);
    }
}