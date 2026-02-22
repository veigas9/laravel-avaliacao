<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('precos_base', function (Blueprint $table) {
            $table->id();

            $table->string('prc_cod_prod')->index();

            // Valores como STRING (tem vírgula, texto, espaços, "sem preço")
            $table->string('prc_valor')->nullable();

            $table->string('prc_moeda')->nullable();

            // Percentuais e descontos vêm como texto (5%, 0, NULL, etc)
            $table->string('prc_desc')->nullable();
            $table->string('prc_acres')->nullable();

            // Valor promocional também inconsistente
            $table->string('prc_promo')->nullable();

            // Datas em múltiplos formatos → STRING
            $table->string('prc_dt_ini_promo')->nullable();
            $table->string('prc_dt_fim_promo')->nullable();
            $table->string('prc_dt_atual')->nullable();

            // Metadados
            $table->string('prc_origem')->nullable();
            $table->string('prc_tipo_cli')->nullable();
            $table->string('prc_vend_resp')->nullable();
            $table->string('prc_obs')->nullable();

            // Status vem como texto ("ativo" / "inativo")
            $table->string('prc_status')->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('precos_base');
    }
};