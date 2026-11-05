<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';
    protected $fillable = [
        'titulo',
        'etiqueta',
        'cuerpo',
    ];

    public function getRouteKeyName(): string
    {
        return 'etiqueta';
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Comprueba si la noticia tiene algún comentario.
     */
    public function tieneComentarios(): bool
    {
        if ($this->relationLoaded('comentarios')) {
            return $this->comentarios->isNotEmpty();
        }

        return $this->comentarios()->exists();
    }

    /**
     * Comprueba si la noticia puede editarse (máximo 20 minutos desde su publicación).
     */
    public function puedeEditarse(): bool
    {
        if (!$this->created_at) {
            return false;
        }

        return $this->created_at->gt(now()->subMinutes(20));
    }

    /**
     * Comprueba si la noticia puede eliminarse:
     * - Máximo 20 minutos desde su publicación
     * - No debe tener comentarios
     */
    public function puedeEliminarse(): bool
    {
        if (!$this->puedeEditarse()) {
            return false;
        }

        if ($this->tieneComentarios()) {
            return false;
        }

        return true;
    }
}
