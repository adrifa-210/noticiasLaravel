@pushOnce('styles')
    <link href="{{ asset('assets/css/markdown-guide.css') }}" rel="stylesheet">
@endpushOnce

<!-- Mini Guía Markdown basada en styles.css -->
<div class="card mb-3">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2 px-3">
        <span class="fw-bold small text-dark d-inline-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-markdown text-primary" viewBox="0 0 16 16">
                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                <path fill-rule="evenodd" d="M3.5 10.5V5.5h1l1.5 2.5 1.5-2.5h1v5h-1V7.5L6.5 9.5h-1L4.5 7.5v3zm7.5 0V7.5H10V6.5h3v1h-1v3z"/>
            </svg>
            Guía de Formato Markdown
        </span>
        <span class="badge bg-secondary">Haz clic en una fila o botón para aplicar</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0 markdown-guide-table">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-3" style="width: 25%;">Formato</th>
                        <th scope="col" style="width: 32%;">Sintaxis Markdown</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" class="text-end pe-3" style="width: 12%;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-markdown-format="bold" title="Haz clic para aplicar negrita al texto seleccionado o insertar plantilla">
                        <td class="ps-3 fw-semibold">Negrita</td>
                        <td><code>**texto en negrita**</code></td>
                        <td class="text-muted small">Resalta palabras o frases clave</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="bold">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="italic" title="Haz clic para aplicar cursiva al texto seleccionado o insertar plantilla">
                        <td class="ps-3 fw-semibold">Cursiva</td>
                        <td><code>*texto en cursiva*</code></td>
                        <td class="text-muted small">Énfasis o términos destacados</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="italic">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="h1" title="Haz clic para aplicar Encabezado principal (H1)">
                        <td class="ps-3 fw-semibold">Encabezado 1 (H1)</td>
                        <td><code># Título</code></td>
                        <td class="text-muted small">Encabezado principal para secciones</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="h1">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="h2" title="Haz clic para aplicar Subtítulo (H2)">
                        <td class="ps-3 fw-semibold">Encabezado 2 (H2)</td>
                        <td><code>## Subtítulo</code></td>
                        <td class="text-muted small">Subtítulo de nivel medio</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="h2">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="link" title="Haz clic para insertar o envolver en un enlace">
                        <td class="ps-3 fw-semibold">Enlace</td>
                        <td><code>[Texto](https://...)</code></td>
                        <td class="text-muted small">Vínculo a fuentes o referencias</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="link">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="list" title="Haz clic para crear lista con viñetas">
                        <td class="ps-3 fw-semibold">Lista con viñetas</td>
                        <td><code>- Elemento</code></td>
                        <td class="text-muted small">Puntos o ítems desglosados</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="list">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="quote" title="Haz clic para crear bloque de cita">
                        <td class="ps-3 fw-semibold">Cita textual</td>
                        <td><code>&gt; Cita destacada</code></td>
                        <td class="text-muted small">Bloque con sangría para citas</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="quote">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                    <tr data-markdown-format="code" title="Haz clic para aplicar formato de código">
                        <td class="ps-3 fw-semibold">Código</td>
                        <td><code>`código`</code></td>
                        <td class="text-muted small">Texto monoespaciado o técnico</td>
                        <td class="text-end pe-3">
                            <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" data-markdown-format="code">
                                Aplicar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@pushOnce('scripts')
    <script src="{{ asset('assets/js/markdown-guide.js') }}"></script>
@endpushOnce
