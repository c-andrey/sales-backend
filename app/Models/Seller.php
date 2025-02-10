<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected $appends = ['comission'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    protected function comission(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->sales()->sum('comission')
        );
    }
}
