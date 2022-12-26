<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'full_discount',
        'percentage_discount',
        'active',
        'discount',
        'sort',
    ];

    public function adresses(){
        return $this->hasMany(Address::class, 'store_id', 'id');
    }

    public function employees(){
        return $this->hasMany(StoreEmployee::class, 'store_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'store_id', 'id');
    }

    public function sorts(){
        return $this->hasMany(Sort::class, 'store_id', 'id');
    }
}
