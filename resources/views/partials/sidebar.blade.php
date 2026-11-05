@php
    $ultimasNoticias = $ultimasNoticias ?? \App\Models\Noticia::latest()->take(3)->get();
    $totalNoticias = $totalNoticias ?? ($estadisticas['totalNoticias'] ?? \App\Models\Noticia::count());
    $totalComentarios = $totalComentarios ?? ($estadisticas['totalComentarios'] ?? \App\Models\Comentario::count());
    $totalPositivas = $totalPositivas ?? ($estadisticas['positivas'] ?? \App\Models\Comentario::where('valoracion', 'positivo')->count());
    $totalNegativas = $totalNegativas ?? ($estadisticas['negativas'] ?? \App\Models\Comentario::where('valoracion', 'negativo')->count());
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

<!-- Widget de Estadísticas Totales -->
<div class="card mb-4">
    <div class="card-header fw-bold d-flex align-items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-fill text-primary" viewBox="0 0 16 16">
            <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
        </svg>
        <span>Estadísticas del Portal</span>
    </div>
    <div class="card-body">
        <div class="row g-2 text-center">
            <!-- Total Noticias -->
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <div class="d-flex align-items-center justify-content-center text-primary mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                            <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z"/>
                            <path d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm5-4h5v1H7zm0 2h5v1H7zm0 2h5v1H7z"/>
                        </svg>
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">{{ $totalNoticias }}</div>
                    <small class="text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Noticias</small>
                </div>
            </div>
            <!-- Total Comentarios -->
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <div class="d-flex align-items-center justify-content-center text-secondary mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                            <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                        </svg>
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">{{ $totalComentarios }}</div>
                    <small class="text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Comentarios</small>
                </div>
            </div>
            <!-- Positivas Totales -->
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <div class="d-flex align-items-center justify-content-center text-success mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.065a1.5 1.5 0 0 1 .974.786l1.71 2.565c.294.441.451.96.451 1.49v.219a.5.5 0 0 0 .5.5h2.463c.969 0 1.706.87 1.55 1.83l-.707 4.382A2 2 0 0 1 13.917 14H7.5a1.5 1.5 0 0 1-1.5-1.5v-7.14a2 2 0 0 1 .456-1.282l.5-.633zM3 5a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1.5A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H3z"/>
                        </svg>
                    </div>
                    <div class="h5 mb-0 fw-bold text-success">{{ $totalPositivas }}</div>
                    <small class="text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Positivas</small>
                </div>
            </div>
            <!-- Negativas Totales -->
            <div class="col-6">
                <div class="p-2 border rounded bg-light">
                    <div class="d-flex align-items-center justify-content-center text-danger mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                            <path d="M6.956 14.255c.065.936.952 1.659 1.908 1.42l.261-.065a1.5 1.5 0 0 0 .974-.786l1.71-2.565c.294-.441.451-.96.451-1.49v-.219a.5.5 0 0 1 .5-.5h2.463c.969 0 1.706-.87 1.55-1.83l-.707-4.382A2 2 0 0 0 13.917 2H7.5A1.5 1.5 0 0 0 6 3.5v7.14a2 2 0 0 0 .456 1.282l.5.633zM3 11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 2.5v7A1.5 1.5 0 0 0 1.5 11H3z"/>
                        </svg>
                    </div>
                    <div class="h5 mb-0 fw-bold text-danger">{{ $totalNegativas }}</div>
                    <small class="text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Negativas</small>
                </div>
            </div>
        </div>

        @if(($totalPositivas + $totalNegativas) > 0)
            @php
                $porcentajePositivo = round(($totalPositivas / ($totalPositivas + $totalNegativas)) * 100);
            @endphp
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>Aprobación</span>
                    <span class="fw-semibold text-dark">{{ $porcentajePositivo }}%</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $porcentajePositivo }}%" aria-valuenow="{{ $porcentajePositivo }}" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ 100 - $porcentajePositivo }}%" aria-valuenow="{{ 100 - $porcentajePositivo }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        @endif
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
