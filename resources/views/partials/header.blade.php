<!-- Page header with logo and tagline-->
<header class="py-5 text-white mb-4 shadow-sm" style="background: linear-gradient(135deg, #0f144d 0%, #0f144d 100%);">
    <div class="container py-3">
        <div class="text-center my-3">
            <!-- Badge / Pill -->
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill bg-white bg-opacity-25 text-white border border-white border-opacity-25 small fw-semibold">
                <span class="d-inline-block rounded-circle bg-white" style="width: 8px; height: 8px;"></span>
                <span>Diario Digital de Actualidad</span>
            </div>

            <!-- Header Title -->
            <h1 class="display-4 fw-bolder text-white mb-3">
                @hasSection('header_title')
                    @yield('header_title')
                @else
                    Info<span class="text-white-50">Pulso</span>
                @endif
            </h1>

            <!-- Header Subtitle -->
            <p class="lead text-white text-opacity-90 mx-auto mb-4" style="max-width: 680px; font-size: 1.15rem;">
                @yield('header_subtitle', 'El portal donde las noticias cobran vida y la comunidad tiene la palabra. Infórmate, comparte tu opinión y valora la actualidad en tiempo real.')
            </p>

            <!-- Action buttons -->
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ route('noticia.create') }}" class="btn btn-light text-primary fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                    Publicar Noticia
                </a>
                <a href="{{ route('noticia.index') }}" class="btn btn-outline-light fw-semibold px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    Gestión de Noticias
                </a>
            </div>
        </div>
    </div>
</header>
