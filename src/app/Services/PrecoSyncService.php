<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;

class PrecoSyncService
{
    public function sync(): array
    {
        DB::beginTransaction();

        try {
            $viewPrecos = DB::table('view_precos')->get();
            $now = now();

            $inserted = 0;
            $updated = 0;
            $unchanged = 0;

            foreach ($viewPrecos as $preco) {
                $codigoProduto = $preco->codigo_produto ?? null;
                $tipoCliente = $preco->tipo_cliente ?? null;

                if ($codigoProduto === null || $tipoCliente === null) {
                    continue;
                }

                $payload = [
                    'valor'             => $preco->valor,
                    'moeda'             => $preco->moeda,
                    'valor_promocional' => $preco->valor_promocional,
                    'inicio_promocao'   => $preco->inicio_promocao ?? null,
                    'fim_promocao'      => $preco->fim_promocao ?? null,
                    'origem'            => $preco->origem,
                    'vendedor'          => $preco->vendedor,
                    'observacao'        => $preco->observacao,
                    'ativo'             => $preco->ativo,
                ];

                $existing = DB::table('preco_insercao')
                    ->where('codigo_produto', $codigoProduto)
                    ->where('tipo_cliente', $tipoCliente)
                    ->first();

                if ($existing === null) {
                    DB::table('preco_insercao')->insert(array_merge(
                        [
                            'codigo_produto' => $codigoProduto,
                            'tipo_cliente' => $tipoCliente,
                        ],
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
                    DB::table('preco_insercao')
                        ->where('codigo_produto', $codigoProduto)
                        ->where('tipo_cliente', $tipoCliente)
                        ->update(array_merge($payload, ['updated_at' => $now]));
                    $updated++;
                    continue;
                }

                $unchanged++;
            }

            $removed = DB::table('preco_insercao')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('view_precos')
                        ->whereColumn('view_precos.codigo_produto', 'preco_insercao.codigo_produto')
                        ->whereColumn('view_precos.tipo_cliente', 'preco_insercao.tipo_cliente');
                })
                ->delete();

            DB::commit();

            return [
                'status'      => 'success',
                'total'       => $viewPrecos->count(),
                'inseridos'   => $inserted,
                'atualizados' => $updated,
                'removidos'   => $removed,
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
