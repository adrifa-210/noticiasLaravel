<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold d-inline-flex align-items-center gap-2" href="{{ url('/') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-newspaper text-primary" viewBox="0 0 16 16">
                <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z"/>
                <path d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm5-4h5v1H7zm0 2h5v1H7zm0 2h5v1H7z"/>
            </svg>
            <span><span class="text-white">Info</span><span class="text-primary">Pulso</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('noticia/crear') ? 'active' : '' }}" href="{{ url('/noticia/crear') }}">Nueva Noticia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('noticia.index') ? 'active' : '' }}" href="{{ route('noticia.index') }}">Gestión de Noticias</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
