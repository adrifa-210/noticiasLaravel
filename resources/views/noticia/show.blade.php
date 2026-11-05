@extends('template.base')

@section('title', ($noticia->titulo ?? 'Noticia') . ' - InfoPulso')

@section('container_class', 'container py-4')

@section('content')
    <!-- Alertas globales -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($errors) && $errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ $errors->first('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Contenido de la Noticia -->
    <article>
        <!-- Cabecera de la noticia -->
        <header class="mb-4">
            <!-- Título de la noticia -->
            <h1 class="fw-bolder mb-1">{{ $noticia->titulo }}</h1>
            <!-- Metadatos de la noticia -->
            <div class="text-muted fst-italic mb-2">
                Publicado el {{ $noticia->created_at ? $noticia->created_at->format('d/m/Y H:i') : '' }}
            </div>

            <!-- Botones de Editar y Eliminar -->
            @if($noticia->puedeEditarse() || $noticia->puedeEliminarse())
                <div class="d-flex gap-2 mt-3">
                    @if($noticia->puedeEditarse())
                        <a href="{{ route('noticia.edit', $noticia) }}" class="btn btn-sm btn-outline-primary">
                            Editar
                        </a>
                    @endif
                    @if($noticia->puedeEliminarse())
                        <form action="{{ route('noticia.destroy', $noticia) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                Eliminar
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </header>
        <!-- Preview image figure-->
        <figure class="mb-4">
            <img class="img-fluid rounded w-100" src="https://picsum.photos/900/400" alt="{{ $noticia->titulo }}" />
        </figure>
        <!-- Post content-->
        <section class="mb-5">
            <div class="fs-5">
                {!! Str::markdown($noticia->cuerpo ?? '', [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]) !!}
            </div>
        </section>
    </article>
    <!-- Comments section-->
    <section class="mb-5">
        <div class="card bg-light">
            <div class="card-body">
                <!-- Alertas -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(isset($errors) && $errors->has('error'))
                    <div class="alert alert-danger mb-3" role="alert">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <!-- Comment form-->
                <form class="mb-4" method="POST" action="{{ route('comentario.store', $noticia) }}">
                    @csrf
                    <h5 class="fw-bold mb-3">Deja un comentario</h5>

                    <div class="row mb-3">
                        <!-- Campo Autor -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="autor" class="form-label fw-semibold small">Nombre de usuario</label>
                            <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}" placeholder="Tu nombre o alias" maxlength="100" required>
                            @error('autor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Valoración (Radio buttons) -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small d-block">¿Qué te parece la noticia?</label>
                            <div class="d-flex align-items-center gap-3 pt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="valoracion" id="val_pos" value="positivo" {{ old('valoracion', 'positivo') === 'positivo' ? 'checked' : '' }} required>
                                    <label class="form-check-label text-success fw-semibold d-inline-flex align-items-center gap-1" for="val_pos">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.065a1.5 1.5 0 0 1 .974.786l1.71 2.565c.294.441.451.96.451 1.49v.219a.5.5 0 0 0 .5.5h2.463c.969 0 1.706.87 1.55 1.83l-.707 4.382A2 2 0 0 1 13.917 14H7.5a1.5 1.5 0 0 1-1.5-1.5v-7.14a2 2 0 0 1 .456-1.282l.5-.633zM3 5a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1.5A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H3z"/>
                                        </svg>
                                        Positivo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="valoracion" id="val_neg" value="negativo" {{ old('valoracion') === 'negativo' ? 'checked' : '' }} required>
                                    <label class="form-check-label text-danger fw-semibold d-inline-flex align-items-center gap-1" for="val_neg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                            <path d="M6.956 14.255c.065.936.952 1.659 1.908 1.42l.261-.065a1.5 1.5 0 0 0 .974-.786l1.71-2.565c.294-.441.451-.96.451-1.49v-.219a.5.5 0 0 1 .5-.5h2.463c.969 0 1.706-.87 1.55-1.83l-.707-4.382A2 2 0 0 0 13.917 2H7.5A1.5 1.5 0 0 0 6 3.5v7.14a2 2 0 0 0 .456 1.282l.5.633zM3 11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 2.5v7A1.5 1.5 0 0 0 1.5 11H3z"/>
                                        </svg>
                                        Negativo
                                    </label>
                                </div>
                            </div>
                            @error('valoracion')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo Cuerpo -->
                    <div class="mb-3">
                        <label for="cuerpo" class="form-label fw-semibold small">Comentario</label>
                        <textarea class="form-control @error('cuerpo') is-invalid @enderror" id="cuerpo" name="cuerpo" rows="3" placeholder="Escribe lo que opinas sobre esta noticia..." required>{{ old('cuerpo') }}</textarea>
                        @error('cuerpo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Publicar Comentario</button>
                </form>

                <hr class="my-4">

                <!-- Lista de Comentarios -->
                <h5 class="fw-bold mb-3">Comentarios ({{ $noticia->comentarios->count() }})</h5>

                @forelse($noticia->comentarios->sortByDesc('created_at') as $comentario)
                    <div class="d-flex mb-3 p-3 bg-white rounded border shadow-sm">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px; font-size: 1.1rem;">
                                {{ strtoupper(substr($comentario->autor, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Contenido del comentario -->
                        <div class="ms-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <span class="fw-bold">{{ $comentario->autor }}</span>
                                    @if($comentario->valoracion === 'positivo')
                                        <span class="badge bg-success ms-1 d-inline-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                                <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.065a1.5 1.5 0 0 1 .974.786l1.71 2.565c.294.441.451.96.451 1.49v.219a.5.5 0 0 0 .5.5h2.463c.969 0 1.706.87 1.55 1.83l-.707 4.382A2 2 0 0 1 13.917 14H7.5a1.5 1.5 0 0 1-1.5-1.5v-7.14a2 2 0 0 1 .456-1.282l.5-.633zM3 5a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1.5A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H3z"/>
                                            </svg>
                                            Positivo
                                        </span>
                                    @else
                                        <span class="badge bg-danger ms-1 d-inline-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                                <path d="M6.956 14.255c.065.936.952 1.659 1.908 1.42l.261-.065a1.5 1.5 0 0 0 .974-.786l1.71-2.565c.294-.441.451-.96.451-1.49v-.219a.5.5 0 0 1 .5-.5h2.463c.969 0 1.706-.87 1.55-1.83l-.707-4.382A2 2 0 0 0 13.917 2H7.5A1.5 1.5 0 0 0 6 3.5v7.14a2 2 0 0 0 .456 1.282l.5.633zM3 11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 2.5v7A1.5 1.5 0 0 0 1.5 11H3z"/>
                                            </svg>
                                            Negativo
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted">{{ $comentario->created_at ? $comentario->created_at->format('d/m/Y H:i') : '' }}</small>
                                    
                                    @if($comentario->puedeModificarse())
                                        <!-- Botón Editar (Modal) -->
                                        <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" data-bs-toggle="modal" data-bs-target="#editComentarioModal{{ $comentario->id }}">
                                            Editar
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('comentario.destroy', $comentario) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('¿Seguro que deseas eliminar este comentario?') && confirm('Esta acción no se puede deshacer. ¿Confirmas la eliminación definitiva?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $comentario->cuerpo }}</p>
                        </div>
                    </div>

                    @if($comentario->puedeModificarse())
                        <!-- Modal para Editar Comentario -->
                        <div class="modal fade" id="editComentarioModal{{ $comentario->id }}" tabindex="-1" aria-labelledby="editComentarioLabel{{ $comentario->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('comentario.update', $comentario) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editComentarioLabel{{ $comentario->id }}">Editar Comentario</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold small">Nombre de usuario</label>
                                                <input type="text" name="autor" class="form-control" value="{{ old('autor', $comentario->autor) }}" maxlength="100" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold small d-block">Valoración</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="valoracion" id="edit_pos_{{ $comentario->id }}" value="positivo" {{ old('valoracion', $comentario->valoracion) === 'positivo' ? 'checked' : '' }} required>
                                                        <label class="form-check-label text-success fw-semibold d-inline-flex align-items-center gap-1" for="edit_pos_{{ $comentario->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                                                <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.065a1.5 1.5 0 0 1 .974.786l1.71 2.565c.294.441.451.96.451 1.49v.219a.5.5 0 0 0 .5.5h2.463c.969 0 1.706.87 1.55 1.83l-.707 4.382A2 2 0 0 1 13.917 14H7.5a1.5 1.5 0 0 1-1.5-1.5v-7.14a2 2 0 0 1 .456-1.282l.5-.633zM3 5a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1.5A1.5 1.5 0 0 1 0 13.5v-7A1.5 1.5 0 0 1 1.5 5H3z"/>
                                                            </svg>
                                                            Positivo
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="valoracion" id="edit_neg_{{ $comentario->id }}" value="negativo" {{ old('valoracion', $comentario->valoracion) === 'negativo' ? 'checked' : '' }} required>
                                                        <label class="form-check-label text-danger fw-semibold d-inline-flex align-items-center gap-1" for="edit_neg_{{ $comentario->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                                                <path d="M6.956 14.255c.065.936.952 1.659 1.908 1.42l.261-.065a1.5 1.5 0 0 0 .974-.786l1.71-2.565c.294-.441.451-.96.451-1.49v-.219a.5.5 0 0 1 .5-.5h2.463c.969 0 1.706-.87 1.55-1.83l-.707-4.382A2 2 0 0 0 13.917 2H7.5A1.5 1.5 0 0 0 6 3.5v7.14a2 2 0 0 0 .456 1.282l.5.633zM3 11a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 2.5v7A1.5 1.5 0 0 0 1.5 11H3z"/>
                                                            </svg>
                                                            Negativo
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold small">Comentario</label>
                                                <textarea name="cuerpo" class="form-control" rows="4" required>{{ old('cuerpo', $comentario->cuerpo) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-muted fst-italic mb-0">Todavía no hay comentarios en esta noticia. ¡Sé el primero en opinar!</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

