<?php

namespace App\Services\Sale;

use App\Models\Sale;
use Illuminate\Support\Facades\Log;

class SaleService implements SaleServiceInterface
{
    public function create(array $data): Sale
    {
        $data['comission'] = $data['value'] * 0.085;
        return Sale::create($data);
    }

    public function update(int $id, array $data): Sale
    {
        $sale = Sale::findOrFail($data);
        $sale->update($data);
        return $sale;
    }

    public function delete(int $id): void
    {
        Sale::destroy($id);
    }

    public function get(int $id): Sale
    {
        return Sale::findOrFail($id);
    }

    public function all(): array
    {
        return Sale::all()->toArray();
    }
}
