<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServiceInterface;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private SellerServiceInterface $sellerService
    ) {}

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $seller = $this->sellerService->store($data);

        return response()->json($seller, 201);
    }
}
