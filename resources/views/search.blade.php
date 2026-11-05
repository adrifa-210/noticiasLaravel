@extends('template.base')

@section('title', !empty($query) ? 'Búsqueda: ' . $query . ' - InfoPulso' : 'Buscar Noticias - InfoPulso')

@section('container_class', 'container py-4')

@php
    $highlight = function($text, $searchQuery) {
        $clean = e($text);
        if (empty($searchQuery)) {
            return $clean;
        }

        $terms = array_values(array_filter(preg_split('/\s+/', $searchQuery), function($term) {
            return mb_strlen(trim($term)) >= 2;
        }));

        if (count($terms) > 1) {
            array_unshift($terms, $searchQuery);
        }

        if (empty($terms)) {
            return $clean;
        }

        usort($terms, function($a, $b) {
            return mb_strlen($b) - mb_strlen($a);
        });

        $accentMap = [
            'a' => '[aáàäâAÁÀÄÂ]', 'á' => '[aáàäâAÁÀÄÂ]',
            'e' => '[eéèëêEÉÈËÊ]', 'é' => '[eéèëêEÉÈËÊ]',
            'i' => '[iíìïîIÍÌÏÎ]', 'í' => '[iíìïîIÍÌÏÎ]',
            'o' => '[oóòöôOÓÒÖÔ]', 'ó' => '[oóòöôOÓÒÖÔ]',
            'u' => '[uúùüûUÚÙÜÛ]', 'ú' => '[uúùüûUÚÙÜÛ]', 'ü' => '[uúùüûUÚÙÜÛ]',
        ];

        $patterns = array_map(function($term) use ($accentMap) {
            $quoted = preg_quote($term, '/');
            $len = mb_strlen($quoted);
            $res = '';
            for ($i = 0; $i < $len; $i++) {
                $ch = mb_substr($quoted, $i, 1);
                $res .= $accentMap[mb_strtolower($ch)] ?? $ch;
            }
            return $res;
        }, $terms);

        $pattern = '/(' . implode('|', $patterns) . ')/iu';
        return preg_replace($pattern, '<mark class="bg-warning text-dark px-1 rounded fw-semibold">$1</mark>', $clean);
    };
@endphp

@section('content')
    <!-- Navegación / Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Búsqueda de noticias</li>
        </ol>
    </nav>

    <!-- Alertas de estado -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($errors) && $errors->has('error'))
        <div class="alert alert-danger mb-4" role="alert">
            {{ $errors->first('error') }}
        </div>
    @endif

    <!-- Buscador principal de la vista -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h1 class="h4 fw-bold mb-3 d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                Buscar Noticias
            </h1>
            <p class="text-muted small mb-3">
                Encuentra noticias por palabras clave, frases específicas, coincidencias en el título o contenido.
            </p>
            <form action="{{ route('noticia.search') }}" method="GET">
                <div class="input-group input-group-lg">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Escribe palabras clave o frase a buscar..."
                           value="{{ $query ?? request('search') }}"
                           aria-label="Término de búsqueda"
                           required
                           autofocus />
                    <button class="btn btn-primary px-4 fw-semibold d-inline-flex align-items-center gap-2" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        Buscar
                    </button>
                    @if(!empty($query))
                        <a href="{{ route('noticia.search') }}" class="btn btn-outline-secondary" title="Limpiar búsqueda">
                            Limpiar
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados de la búsqueda -->
    @if(!empty($query))
        <!-- Encabezado con conteo de resultados -->
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h2 class="h5 m-0 fw-bold">
                    Resultados para: <span class="text-primary">"{{ $query }}"</span>
                </h2>
                <small class="text-muted">
                    Se {{ $noticias->count() === 1 ? 'encontró' : 'encontraron' }} <strong>{{ $noticias->count() }}</strong> {{ $noticias->count() === 1 ? 'noticia coincidente' : 'noticias coincidentes' }}
                </small>
            </div>
            @if($noticias->isNotEmpty())
                <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
                    &larr; Volver a la portada
                </a>
            @endif
        </div>

        @if($noticias->isNotEmpty())
            <!-- Listado de Noticias Encontradas -->
            <div class="d-flex flex-column gap-4">
                @foreach($noticias as $noticia)
                    <article class="card shadow-sm border-0 overflow-hidden">
                        <div class="row g-0">
                            <!-- Imagen en miniatura -->
                            <div class="col-md-4">
                                <a href="{{ route('noticia.show', $noticia->etiqueta) }}" class="d-block h-100">
                                    <img src="https://picsum.photos/600/400?random={{ $noticia->id }}"
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover; min-height: 190px;"
                                         alt="{{ $noticia->titulo }}" />
                                </a>
                            </div>

                            <!-- Contenido de la tarjeta -->
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100 p-4">
                                    <div class="small text-muted mb-2">
                                        {{ $noticia->created_at ? $noticia->created_at->format('d/m/Y H:i') : '' }}
                                    </div>

                                    <h3 class="card-title h5 fw-bold mb-2">
                                        <a href="{{ route('noticia.show', $noticia->etiqueta) }}" class="text-decoration-none text-dark">
                                            {!! $highlight($noticia->titulo, $query) !!}
                                        </a>
                                    </h3>

                                    <p class="card-text text-secondary mb-3 flex-grow-1">
                                        {!! $highlight(Str::limit($noticia->cuerpo, 200), $query) !!}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-auto">
                                        <a href="{{ route('noticia.show', $noticia->etiqueta) }}" class="btn btn-sm btn-primary fw-semibold">
                                            Leer noticia completa &rarr;
                                        </a>
                                        <span class="text-muted small">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-dots me-1" viewBox="0 0 16 16">
                                                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.52 1.205c-.14.28-.27.53-.38.742a.5.5 0 0 0 .5.753q.3.003.595-.098m.662-1.378c.324-.175.76-.367 1.343-.518a.5.5 0 0 0 .39-.42 8 8 0 0 1 3.44-6.49 7.4 7.4 0 0 1 8 0 8 8 0 0 1 3.44 6.49.5.5 0 0 0 .39.42c.583.151 1.019.343 1.343.518-.088-.26-.188-.564-.298-.898a9.4 9.4 0 0 0-.46-1.077A7.95 7.95 0 0 0 1 8c0-3.314 3.134-6 7-6s7 2.686 7 6-3.134 6-7 6c-.846 0-1.66-.11-2.428-.318a.5.5 0 0 0-.424.08c-.495.337-1.41.745-2.61 1.036"/>
                                            </svg>
                                            {{ $noticia->comentarios->count() }} {{ $noticia->comentarios->count() === 1 ? 'comentario' : 'comentarios' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Sin resultados -->
            <div class="card shadow-sm border-0 text-center p-5 my-4">
                <div class="card-body">
                    <div class="text-muted mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-secondary opacity-50" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v1a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m-3.854 4.146a.5.5 0 0 1 .708 0 2 2 0 0 0 2.828 0 .5.5 0 1 1 .708.708 3 3 0 0 1-4.244 0 .5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <h3 class="h4 fw-bold">No se encontraron noticias</h3>
                    <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                        No hay ninguna noticia que coincida con los términos <span class="badge bg-light text-dark border">"{{ $query }}"</span>.
                    </p>
                    <div class="card bg-light border-0 mx-auto p-3 text-start mb-4" style="max-width: 520px;">
                        <h6 class="fw-bold mb-2">Sugerencias para tu búsqueda:</h6>
                        <ul class="text-muted small mb-0 ps-3">
                            <li>Revisa si hay errores ortográficos o tipográficos.</li>
                            <li>Prueba con palabras clave más generales o sinónimos.</li>
                            <li>Utiliza menos palabras o términos individuales sueltos.</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('noticia.search') }}" class="btn btn-outline-primary fw-semibold">
                            Nueva búsqueda
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-primary fw-semibold">
                            Ver todas las noticias
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Estado inicial cuando se visita la página sin término de búsqueda -->
        <div class="card shadow-sm border-0 text-center p-5 my-4">
            <div class="card-body">
                <div class="text-muted mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="text-primary opacity-75" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </div>
                <h3 class="h4 fw-bold">Escribe un término para comenzar</h3>
                <p class="text-muted mx-auto mb-4" style="max-width: 480px;">
                    Puedes ingresar palabras clave como el título de la noticia, frases o términos coincidentes tanto en la barra superior como en el buscador del sidebar lateral.
                </p>
                <a href="{{ url('/') }}" class="btn btn-outline-primary fw-semibold">
                    Explorar noticias en portada
                </a>
            </div>
        </div>
    @endif
@endsection
