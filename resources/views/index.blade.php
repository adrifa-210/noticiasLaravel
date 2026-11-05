@extends('template.base')

@section('title', 'InfoPulso - Diario Digital de Actualidad')

@section('header')
    @include('partials.header')
@endsection

@section('content')
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

    <!-- Noticia Destacada -->
    @if ($featured = $noticias->first())
        <div class="card mb-4 shadow-sm border-0 overflow-hidden">
            <a href="{{ route('noticia.show', $featured->etiqueta) }}">
                <img class="card-img-top" src="https://picsum.photos/850/350" alt="{{ $featured->titulo }}" />
            </a>
            <div class="card-body p-4">
                <div class="small text-muted mb-2">
                    Publicado el {{ $featured->created_at ? $featured->created_at->format('d/m/Y H:i') : '' }}
                </div>
                <h2 class="card-title h3 fw-bold">
                    <a href="{{ route('noticia.show', $featured->etiqueta) }}" class="text-decoration-none text-dark">
                        {{ $featured->titulo }}
                    </a>
                </h2>
                <p class="card-text text-secondary">{{ Str::limit($featured->cuerpo, 220) }}</p>
                <div class="d-flex justify-content-between align-items-center pt-2">
                    <a class="btn btn-primary fw-semibold" href="{{ route('noticia.show', $featured->etiqueta) }}">
                        Leer noticia &rarr;
                    </a>
                    <span class="text-muted small">
                        {{ $featured->comentarios->count() }} {{ $featured->comentarios->count() === 1 ? 'comentario' : 'comentarios' }}
                    </span>
                </div>
            </div>
        </div>
    @else
        <!-- Banner por defecto cuando no hay noticias -->
        <div class="card mb-4 shadow-sm text-center p-5">
            <div class="card-body">
                <h2 class="card-title fw-bold">Bienvenido a InfoPulso</h2>
                <p class="card-text text-muted my-3">
                    Actualmente no hay ninguna noticia disponible. ¡Sé el primero en publicar una historia para la comunidad!
                </p>
                <a href="{{ route('noticia.create') }}" class="btn btn-warning fw-semibold px-4 py-2">
                    + Redactar Primera Noticia
                </a>
            </div>
        </div>
    @endif

    <!-- Cuadrícula para el resto de noticias -->
    @if ($noticias->skip(1)->isNotEmpty())
    <div class="row">
        @foreach ($noticias->skip(1) as $noticia)
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                <a href="{{ route('noticia.show', $noticia->etiqueta) }}">
                    <img class="card-img-top" src="https://picsum.photos/700/350?random={{ $noticia->id }}" alt="{{ $noticia->titulo }}" />
                </a>
                <div class="card-body d-flex flex-column p-4">
                    <div class="small text-muted mb-2">
                        {{ $noticia->created_at ? $noticia->created_at->format('d/m/Y') : '' }}
                    </div>
                    <h3 class="card-title h5 fw-bold">
                        <a href="{{ route('noticia.show', $noticia->etiqueta) }}" class="text-decoration-none text-dark">
                            {{ $noticia->titulo }}
                        </a>
                    </h3>
                    <p class="card-text text-secondary flex-grow-1">{{ Str::limit($noticia->cuerpo, 120) }}</p>
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-2">
                        <a class="btn btn-sm btn-outline-primary fw-semibold" href="{{ route('noticia.show', $noticia->etiqueta) }}">
                            Leer más &rarr;
                        </a>
                        <span class="text-muted small">
                            {{ $noticia->comentarios->count() }} {{ $noticia->comentarios->count() === 1 ? 'comentario' : 'comentarios' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
@endsection
