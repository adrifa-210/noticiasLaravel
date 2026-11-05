<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Noticia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    private const RULES = [
        'autor' => 'required|string|max:100|min:2',
        'valoracion' => 'required|in:positivo,negativo',
        'cuerpo' => 'required|string|min:2',
    ];

    private const MESSAGES = [
        'autor.required' => 'El autor es requerido.',
        'autor.string' => 'El autor debe ser una cadena de texto.',
        'autor.max' => 'El autor no puede superar los 100 caracteres.',
        'autor.min' => 'El autor debe tener al menos 2 caracteres.',
        'valoracion.required' => 'La valoración es requerida.',
        'valoracion.in' => 'La valoración debe ser positivo o negativo.',
        'cuerpo.required' => 'El comentario es requerido.',
        'cuerpo.string' => 'El comentario debe ser texto.',
        'cuerpo.min' => 'El comentario debe tener al menos 2 caracteres.',
    ];

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Noticia $noticia): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $noticia->comentarios()->create([
                'autor' => $request->autor,
                'valoracion' => $request->valoracion,
                'cuerpo' => $request->cuerpo,
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al publicar el comentario: ' . $e->getMessage(),
            ]);
        }

        return redirect()->route('noticia.show', $noticia)->with('success', 'Comentario publicado correctamente.');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comentario $comentario): RedirectResponse
    {
        if (!$comentario->puedeModificarse()) {
            return back()->withErrors([
                'error' => 'No se puede editar un comentario que lleva más de 5 minutos publicado.',
            ]);
        }

        $validator = Validator::make($request->all(), self::RULES, self::MESSAGES);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $comentario->update($request->only(['autor', 'valoracion', 'cuerpo']));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al actualizar el comentario: ' . $e->getMessage(),
            ]);
        }

        return redirect()->route('noticia.show', $comentario->noticia)->with('success', 'Comentario actualizado correctamente.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comentario $comentario): RedirectResponse
    {
        if (!$comentario->puedeEliminarse()) {
            return back()->withErrors([
                'error' => 'No se puede eliminar un comentario que lleva más de 5 minutos publicado.',
            ]);
        }

        $noticia = $comentario->noticia;

        try {
            $comentario->delete();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al eliminar el comentario: ' . $e->getMessage(),
            ]);
        }

        return redirect()->route('noticia.show', $noticia)->with('success', 'Comentario eliminado correctamente.');
    }
}

