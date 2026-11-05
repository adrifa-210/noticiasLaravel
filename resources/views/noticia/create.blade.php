@extends('template.base')

@section('title', 'Publicar Noticia - InfoPulso')

@section('container_class', 'container py-4')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h4 m-0">Crear Nueva Noticia</h2>
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

            <form action="{{ url('/noticia') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo Título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Escribe el título de la noticia" maxlength="200" required>
                    @error('titulo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo Cuerpo -->
                <div class="mb-3">
                    <label for="cuerpo" class="form-label">Cuerpo</label>
                    <textarea class="form-control @error('cuerpo') is-invalid @enderror" id="cuerpo" name="cuerpo" rows="6" placeholder="Escribe el contenido o cuerpo de la noticia...">{{ old('cuerpo') }}</textarea>
                    @error('cuerpo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo Seleccionar Archivo -->
                <div class="mb-3">
                    <label for="archivo" class="form-label">Seleccionar archivo (txt, md)</label>
                    <input type="file" class="form-control @error('archivo') is-invalid @enderror" id="archivo" name="archivo">
                    @error('archivo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botón de publicar -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Publicar</button>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

