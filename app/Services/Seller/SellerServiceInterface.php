<?php

namespace App\Services\Seller;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

interface SellerServiceInterface
{
    public function store(array $data): Seller;
    public function update(int $id, array $data): Seller;
    public function show(int $id): ?Seller;
    public function index(): Collection;
    public function delete(int $id): void;
    public function retrieveSalesBySeller(int $sellerId): Collection;
}
