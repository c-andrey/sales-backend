<?php

namespace App\Services\Seller;

use App\Models\Seller;

interface SellerServiceInterface
{
    public function store(array $data): Seller;
}
