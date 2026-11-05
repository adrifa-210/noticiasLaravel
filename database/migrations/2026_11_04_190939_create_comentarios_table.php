<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('noticia_id');
            $table->string('autor', 100);
            $table->text('cuerpo');
            $table->enum('valoracion', ['positivo', 'negativo']);
            $table->timestamps();

            $table->foreign('noticia_id')->references('id')->on('noticias')->onDelete('cascade');
        });
    }

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
