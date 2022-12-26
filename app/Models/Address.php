<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'type',
        'state',
        'city',
        'street',
        'zip_code',
        'number',
        'complement',
    ];

    public function store_address(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function user_address(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
