<?php

namespace App\Services\Sale;

use App\Exceptions\HttpException;
use App\Models\Sale;

class SaleService implements SaleServiceInterface
{
    public function create(array $data): Sale
    {
        $data['comission'] = $data['value'] * 0.085;
        return Sale::create($data);
    }

    public function update(int $id, array $data): Sale
    {
        $sale = Sale::find($id);

        if (!$sale) {
            throw new HttpException('Sale not found', 404);
        }

        $data['comission'] = $data['value'] * 0.085;
        $sale->update($data);
        return $sale;
    }

    public function delete(int $id): void
    {
        $sale = Sale::find($id);

        if (!$sale) {
            throw new HttpException('Sale not found', 404);
        }

        $sale->delete();
    }

    public function get(int $id): Sale
    {
        $sale = Sale::find($id);

        if (!$sale) {
            throw new HttpException('Sale not found', 404);
        }

        return $sale;
    }

    public function all(): array
    {
        return Sale::all()->toArray();
    }
}
