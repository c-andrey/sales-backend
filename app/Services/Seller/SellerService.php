<?php

namespace App\Services\Seller;

use App\Models\Seller;

class SellerService implements SellerServiceInterface
{
    public function store(array $data): Seller
    {
        return Seller::create($data);
    }
}
