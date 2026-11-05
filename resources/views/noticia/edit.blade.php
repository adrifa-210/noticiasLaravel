@extends('template.base')

@section('title', 'Editar Noticia - InfoPulso')

@section('container_class', 'container py-4')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h4 m-0">Editar Noticia</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <form action="{{ route('noticia.update', $noticia) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo Título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo ?? '') }}" placeholder="Escribe el título de la noticia" maxlength="200" required>
                    @error('titulo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo Cuerpo -->
                <div class="mb-3">
                    <label for="cuerpo" class="form-label">Cuerpo</label>
                    <textarea class="form-control @error('cuerpo') is-invalid @enderror" id="cuerpo" name="cuerpo" rows="6" placeholder="Escribe el contenido o cuerpo de la noticia..." required>{{ old('cuerpo', $noticia->cuerpo ?? '') }}</textarea>
                    @error('cuerpo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('noticia.show', $noticia) }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

