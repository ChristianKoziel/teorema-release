<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->string('numero_chamado');
            $table->string('agente');
            $table->text('descricao');
            $table->string('release_codigo');
            $table->date('data_liberacao');
            $table->enum('tipo_chamada', ['Correção', 'Melhoria']);
            $table->text('descricao_correcao');
            $table->string('imagem')->nullable();
            $table->string('link_manual')->nullable();
            $table->integer('ano');
            $table->integer('mes');
            $table->integer('semana');
            $table->enum('status', ['rascunho', 'em_analise', 'aprovado'])->default('rascunho');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Index para otimização das queries
            $table->index(['ano', 'mes', 'semana']);
            $table->index('status');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};