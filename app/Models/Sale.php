<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_id',
        'value',
        'comission',
        'sale_date'
    ];

    protected $casts = [
        'sale_date' => 'datetime'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
