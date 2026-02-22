<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produto_insercao', function (Blueprint $table) {
            $table->id();

            // Chave de negócio
            $table->string('codigo', 30)->unique();

            // Dados do produto
            $table->string('nome', 150);
            $table->text('descricao')->nullable();
            $table->string('categoria', 100)->nullable();
            $table->string('subcategoria', 100)->nullable();
            $table->string('fabricante', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('cor', 50)->nullable();
            $table->string('unidade', 20)->nullable();
            $table->date('data_cadastro')->nullable();

            // Controle
            $table->boolean('ativo')->default(true);
            $table->date('data_atualizacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produto_insercao');
    }
};
