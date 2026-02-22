<?php

namespace App\Http\Controllers;

use App\Services\ProdutoSyncService;
use App\Services\PrecoSyncService;

class SyncController extends Controller
{
    public function syncProdutos(ProdutoSyncService $service)
    {
        return response()->json(
            $service->sync()
        );
    }

    public function syncPrecos(PrecoSyncService $service)
    {
        return response()->json(
            $service->sync()
        );
    }
}