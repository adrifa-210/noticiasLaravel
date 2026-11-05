<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $fillable = [
        'autor',
        'cuerpo',
        'valoracion',
        'noticia_id'
    ];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

    /**
     * Comprueba si el comentario puede editarse o eliminarse (máximo 5 minutos desde su publicación).
     */
    public function puedeModificarse(): bool
    {
        if (!$this->created_at) {
            return false;
        }

        return $this->created_at->gt(now()->subMinutes(5));
    }

    public function puedeEliminarse(): bool
    {
        return $this->puedeModificarse();
    }
}
