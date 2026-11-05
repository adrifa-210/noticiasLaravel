@pushOnce('styles')
    <link href="{{ asset('assets/css/markdown-guide.css') }}" rel="stylesheet">
@endpushOnce

<!-- Mini Guía Markdown Interactiva -->
<div class="card bg-light border mb-3">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="card-subtitle fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-markdown text-primary" viewBox="0 0 16 16">
                    <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                    <path fill-rule="evenodd" d="M3.5 10.5V5.5h1l1.5 2.5 1.5-2.5h1v5h-1V7.5L6.5 9.5h-1L4.5 7.5v3zm7.5 0V7.5H10V6.5h3v1h-1v3z"/>
                </svg>
                <span>Mini Guía de Formato Markdown</span>
            </h6>
            <span class="badge bg-white text-primary border">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-cursor-fill me-1" viewBox="0 0 16 16">
                    <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
                </svg>
                Clic para insertar / formatear
            </span>
        </div>
        <p class="small text-muted mb-2">
            Pulsa sobre cualquier formato para aplicarlo al texto seleccionado en el cuerpo o insertar una plantilla:
        </p>
        <div class="row g-2 small">
            <!-- Negrita -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="bold" title="Aplica negrita al texto seleccionado o inserta plantilla">
                    <code class="text-primary fw-bold">**negrita**</code>
                    <div class="text-muted small mt-1">Resaltar en negrita</div>
                </button>
            </div>

            <!-- Cursiva -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="italic" title="Aplica cursiva al texto seleccionado o inserta plantilla">
                    <code class="text-primary fst-italic">*cursiva*</code>
                    <div class="text-muted small mt-1">Texto en cursiva</div>
                </button>
            </div>

            <!-- Encabezado H1 -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="h1" title="Convierte en encabezado principal (H1)">
                    <code class="text-primary fw-bold"># Título</code>
                    <div class="text-muted small mt-1">Encabezado principal</div>
                </button>
            </div>

            <!-- Encabezado H2 -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="h2" title="Convierte en subtítulo o sección (H2)">
                    <code class="text-primary fw-semibold">## Subtítulo</code>
                    <div class="text-muted small mt-1">Encabezado medio</div>
                </button>
            </div>

            <!-- Enlace -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="link" title="Inserta un enlace con el texto seleccionado">
                    <code class="text-primary">[Texto](https://...)</code>
                    <div class="text-muted small mt-1">Enlace a fuentes</div>
                </button>
            </div>

            <!-- Lista -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="list" title="Crea una lista con viñetas">
                    <code class="text-primary">- Elemento</code>
                    <div class="text-muted small mt-1">Lista con viñetas</div>
                </button>
            </div>

            <!-- Cita -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="quote" title="Convierte en bloque de cita destacada">
                    <code class="text-primary">&gt; Cita textual</code>
                    <div class="text-muted small mt-1">Bloque destacado</div>
                </button>
            </div>

            <!-- Código -->
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-outline-secondary bg-white text-dark text-start w-100 p-2 h-100 markdown-format-btn" data-markdown-format="code" title="Aplica formato de código monoespaciado">
                    <code class="text-primary">`código`</code>
                    <div class="text-muted small mt-1">Código monoespacio</div>
                </button>
            </div>
        </div>
    </div>
</div>

@pushOnce('scripts')
    <script src="{{ asset('assets/js/markdown-guide.js') }}"></script>
@endpushOnce
