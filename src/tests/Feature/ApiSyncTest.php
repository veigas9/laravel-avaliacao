<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_sincronizar_produtos_endpoint_sincroniza_tabela_destino(): void
    {
        $this->seed();

        $response = $this->postJson('/api/sincronizar/produtos');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'status',
                'total',
                'inseridos',
                'atualizados',
                'removidos',
                'inalterados',
            ])
            ->assertJson([
                'status' => 'success',
            ]);

        $this->assertDatabaseCount('produto_insercao', 10);
    }

    public function test_sincronizar_precos_endpoint_sincroniza_tabela_destino(): void
    {
        $this->seed();

        $response = $this->postJson('/api/sincronizar/precos');

        $response
            ->assertOk()
            ->assertJsonStructure([
                'status',
                'total',
                'inseridos',
                'atualizados',
                'removidos',
                'inalterados',
            ])
            ->assertJson([
                'status' => 'success',
            ]);

        $this->assertDatabaseCount('preco_insercao', 10);
    }

    public function test_listagem_produtos_precos_retorna_paginacao(): void
    {
        $this->seed();

        $this->postJson('/api/sincronizar/produtos')->assertOk();
        $this->postJson('/api/sincronizar/precos')->assertOk();

        $response = $this->getJson('/api/produtos-precos?per_page=5&page=1');

        $response
            ->assertOk()
            ->assertJsonPath('current_page', 1)
            ->assertJsonPath('per_page', 5)
            ->assertJsonStructure([
                'current_page',
                'data',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ]);

        $this->assertCount(5, $response->json('data'));
    }
}
