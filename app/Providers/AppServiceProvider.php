<?php

namespace App\Providers;

use App\Models\Comentario;
use App\Models\Noticia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.sidebar', function ($view) {
            $view->with('ultimasNoticias', Noticia::latest()->take(3)->get());
            $view->with('estadisticas', [
                'totalNoticias' => Noticia::count(),
                'totalComentarios' => Comentario::count(),
                'positivas' => Comentario::where('valoracion', 'positivo')->count(),
                'negativas' => Comentario::where('valoracion', 'negativo')->count(),
            ]);
        });
    }
}
