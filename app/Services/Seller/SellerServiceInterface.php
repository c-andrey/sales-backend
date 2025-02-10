<?php

namespace App\Services\Seller;

use App\Models\Seller;

interface SellerServiceInterface
{
    public function store(array $data): Seller;
    public function update(int $id, array $data): Seller;
    public function show(int $id): ?Seller;
    public function index(): array;
    public function delete(int $id): void;
}
