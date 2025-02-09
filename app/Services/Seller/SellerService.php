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

    public function show(int $id): Seller
    {
        return Seller::findOrFail($id);
    }
}
