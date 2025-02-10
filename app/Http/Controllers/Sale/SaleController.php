<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleRequest;
use App\Services\Sale\SaleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function __construct(
        private SaleServiceInterface $saleService
    ) {}

    public function store(CreateSaleRequest $request)
    {
        try {
            $data = $request->all();
            $sale = $this->saleService->create($data);
            return response()->json($sale, 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $sales = $this->saleService->all();
            return response()->json($sales);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    public function show(int $id)
    {
        try {
            $sale = $this->saleService->get($id);
            return response()->json($sale);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    public function update(CreateSaleRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $sale = $this->saleService->update($id, $data);
            return response()->json($sale);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->saleService->delete($id);
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['message' => $th->getMessage()], $th->getCode());
        }
    }
}
