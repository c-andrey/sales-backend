<?php

namespace App\Services\Seller;

use App\Exceptions\HttpException;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

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
            throw new HttpException('Seller not found', 404);
        }

        return $seller;
    }

    public function index(): Collection
    {
        $sellers = Seller::all();
        return $sellers;
    }

    public function delete(int $id): void
    {
        $response = Seller::destroy($id);

        if (!$response) {
            throw new HttpException('Seller not found', 404);
        }
    }

    public function retrieveSalesBySeller(int $sellerId): Collection
    {
        $seller = Seller::find($sellerId);

        if (!$seller) {
            throw new HttpException('Seller not found', 404);
        }

        return $seller->sales;
    }
}
