<?php

namespace App\Services\Seller;

use App\Models\Seller;

class SellerService implements SellerServiceInterface
{
    public function store(array $data): Seller
    {
        return Seller::create($data);
    }

    public function update(int $id, array $data): Seller
    {
        $seller = Seller::findOrFail($id);
        $seller->update($data);

        return $seller;
    }

    public function show(int $id): ?Seller
    {
        $seller = Seller::find($id);

        if (!$seller) {
            throw new \Exception('Seller not found', 404);
        }

        return $seller;
    }

    public function index(): array
    {
        return Seller::all()->toArray();
    }

    public function delete(int $id): void
    {
        $response = Seller::destroy($id);

        if (!$response) {
            throw new \Exception('Seller not found', 404);
        }
    }
}
