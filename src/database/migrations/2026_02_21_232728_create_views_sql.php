<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(file_get_contents(database_path('views/view_produtos.sql')));
        DB::statement(file_get_contents(database_path('views/view_precos.sql')));
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_produtos');
        DB::statement('DROP VIEW IF EXISTS view_precos');
    }
};