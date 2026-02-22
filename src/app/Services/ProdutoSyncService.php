<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;

class ProdutoSyncService
{
    public function sync(): array
    {
        DB::beginTransaction();

        try {
            $produtos = DB::table('view_produtos')->get();
            $now = now();
            $today = $now->toDateString();

            $inserted = 0;
            $updated = 0;
            $unchanged = 0;

            foreach ($produtos as $p) {
                $codigo = $p->codigo ?? null;

                if ($codigo === null) {
                    continue;
                }

                $payload = [
                    'nome'            => $p->nome,
                    'categoria'       => $p->categoria,
                    'subcategoria'    => $p->subcategoria,
                    'descricao'       => $p->descricao,
                    'fabricante'      => $p->fabricante,
                    'modelo'          => $p->modelo,
                    'cor'             => $p->cor,
                    'unidade'         => $p->unidade,
                    'data_cadastro'   => $p->data_cadastro,
                    'ativo'           => $p->ativo ?? 1,
                    'data_atualizacao'=> $today,
                ];

                $existing = DB::table('produto_insercao')
                    ->where('codigo', $codigo)
                    ->first();

                if ($existing === null) {
                    DB::table('produto_insercao')->insert(array_merge(
                        ['codigo' => $codigo],
                        $payload,
                        [
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    ));
                    $inserted++;
                    continue;
                }

                if ($this->hasDifferences($existing, $payload)) {
                    DB::table('produto_insercao')
                        ->where('codigo', $codigo)
                        ->update(array_merge($payload, ['updated_at' => $now]));
                    $updated++;
                    continue;
                }

                $unchanged++;
            }

            $removed = DB::table('produto_insercao')
                ->whereNotIn('codigo', function ($query) {
                    $query->from('view_produtos')->select('codigo');
                })
                ->delete();

            DB::commit();

            return [
                'status'    => 'success',
                'total'     => $produtos->count(),
                'inseridos' => $inserted,
                'atualizados' => $updated,
                'removidos' => $removed,
                'inalterados' => $unchanged,
            ];

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function hasDifferences(object $existing, array $payload): bool
    {
        foreach ($payload as $column => $newValue) {
            $currentValue = $existing->{$column} ?? null;

            if ($this->valuesDiffer($currentValue, $newValue)) {
                return true;
            }
        }

        return false;
    }

    private function valuesDiffer(mixed $current, mixed $new): bool
    {
        if ($current === null || $new === null) {
            return $current !== $new;
        }

        if (is_numeric($current) && is_numeric($new)) {
            return (float) $current !== (float) $new;
        }

        return (string) $current !== (string) $new;
    }
}
