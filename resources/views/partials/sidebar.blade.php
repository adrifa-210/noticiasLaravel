@php
    $ultimasNoticias = $ultimasNoticias ?? \App\Models\Noticia::latest()->take(3)->get();
@endphp

<!-- Side widgets-->
<!-- Widget de Búsqueda -->
<div class="card mb-4">
    <div class="card-header fw-bold">Buscar Noticias</div>
    <div class="card-body">
        <form action="{{ route('noticia.search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título, frases o palabras..." aria-label="Buscar noticias..." required />
                <button class="btn btn-primary" type="submit" title="Buscar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Widget de 3 Últimas Noticias -->
<div class="card mb-4">
    <div class="card-header fw-bold">Últimas Noticias</div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @forelse($ultimasNoticias as $item)
                <li class="list-group-item p-3">
                    <h6 class="mb-1 fw-bold">
                        <a href="{{ route('noticia.show', $item->etiqueta) }}" class="text-decoration-none text-dark">
                            {{ Str::limit($item->titulo, 55) }}
                        </a>
                    </h6>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted">
                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : '' }}
                        </small>
                        <a href="{{ route('noticia.show', $item->etiqueta) }}" class="btn btn-sm btn-outline-primary py-0 px-2">
                            Leer
                        </a>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-muted small py-3">No hay noticias publicadas aún.</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Widget Comunidad InfoPulso -->
<div class="card mb-4">
    <div class="card-header fw-bold">Comunidad InfoPulso</div>
    <div class="card-body">
        <p class="small text-muted mb-3">
            Participa en los debates comentando las noticias de última hora y valorando con opiniones positivas o negativas.
        </p>
        <a href="{{ route('noticia.create') }}" class="btn btn-sm btn-outline-primary w-100 fw-semibold">
            + Redactar Noticia
        </a>
    </div>
</div>
