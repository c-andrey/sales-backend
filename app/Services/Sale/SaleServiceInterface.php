<?php

namespace App\Services\Sale;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

interface SaleServiceInterface
{
    public function create(array $data): Sale;
    public function update(int $id, array $data): Sale;
    public function delete(int $id): void;
    public function get(int $id): Sale;
    public function all(): array;
}
