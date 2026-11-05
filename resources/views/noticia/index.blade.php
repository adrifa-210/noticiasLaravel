@extends('template.base')

@section('title', 'Gestión de Noticias - InfoPulso')

@section('container_class', 'container py-4')

@section('content')
    <!-- Mensajes de éxito y error -->
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

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 m-0 fw-bold">Todas las Noticias</h2>
            <a href="{{ route('noticia.create') }}" class="btn btn-sm btn-primary">
                + Nueva Noticia
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3" style="width: 50px;">#</th>
                            <th scope="col">Título</th>
                            <th scope="col" class="text-nowrap" style="width: 100px;">Fecha</th>
                            <th scope="col" class="text-end pe-3 text-nowrap" style="width: 180px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($noticias as $noticia)
                            <tr>
                                <th scope="row" class="ps-3 text-muted small">{{ $noticia->id }}</th>
                                <td>
                                    <div class="fw-semibold text-break">
                                        <a href="{{ route('noticia.show', $noticia) }}" class="text-decoration-none text-dark">
                                            {{ $noticia->titulo }}
                                        </a>
                                    </div>
                                    <div class="text-muted small font-monospace text-truncate" style="max-width: 280px;" title="{{ $noticia->etiqueta }}">
                                        /{{ $noticia->etiqueta }}
                                    </div>
                                </td>
                                <td class="text-muted small text-nowrap">
                                    {{ $noticia->created_at ? $noticia->created_at->format('d/m/Y') : '-' }}
                                </td>
                                <td class="text-end pe-3 text-nowrap">
                                    <div class="d-inline-flex gap-1 justify-content-end align-items-center">
                                        <!-- Ver -->
                                        <a href="{{ route('noticia.show', $noticia) }}" class="btn btn-sm btn-outline-info py-0 px-2" title="Ver noticia">
                                            Ver
                                        </a>
                                        <!-- Editar -->
                                        @if($noticia->puedeEditarse())
                                            <a href="{{ route('noticia.edit', $noticia) }}" class="btn btn-sm btn-outline-primary py-0 px-2" title="Editar noticia">
                                                Editar
                                            </a>
                                        @endif
                                        <!-- Eliminar con doble confirmación -->
                                        @if($noticia->puedeEliminarse())
                                            <form action="{{ route('noticia.destroy', $noticia) }}" method="POST" class="d-inline m-0"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar la noticia <{{ $noticia->titulo }}>?');">
                                                @csrf
                                                @method('DELETE')   
                                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2" title="Eliminar noticia">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    No hay noticias disponibles. <a href="{{ route('noticia.create') }}">Crea la primera aquí</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
