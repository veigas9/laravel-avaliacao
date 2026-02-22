<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preco_insercao', function (Blueprint $table) {
            $table->id();

            // Chaves de negócio
            $table->string('codigo_produto', 30);
            $table->string('tipo_cliente', 30);

            // Valores
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('moeda', 10)->nullable();

            $table->decimal('valor_promocional', 10, 2)->nullable();
            $table->date('inicio_promocao')->nullable();
            $table->date('fim_promocao')->nullable();

            // Metadados
            $table->string('origem', 50)->nullable();
            $table->string('vendedor', 100)->nullable();
            $table->text('observacao')->nullable();

            $table->boolean('ativo')->default(true);

            $table->timestamps();

            // Garante idempotência do sync
            $table->unique(['codigo_produto', 'tipo_cliente'], 'preco_unique_produto_cliente');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preco_insercao');
    }
};