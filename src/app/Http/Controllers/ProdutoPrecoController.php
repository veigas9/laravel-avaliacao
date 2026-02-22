<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoPrecoController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);

        $query = DB::table('produto_insercao as p')
            ->leftJoin('preco_insercao as pr', 'pr.codigo_produto', '=', 'p.codigo')
            ->select(
                'p.codigo',
                'p.nome',
                'p.categoria',
                'p.subcategoria',
                'p.fabricante',
                'p.modelo',
                'p.ativo',
                'pr.valor',
                'pr.moeda',
                'pr.valor_promocional',
                'pr.tipo_cliente'
            )
            ->selectRaw('COALESCE(pr.valor_promocional, pr.valor) as valor_final')
            ->orderBy('p.codigo');

        return response()->json(
            $query->paginate($perPage)
        );
    }
}
