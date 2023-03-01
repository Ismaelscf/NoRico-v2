<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_sale',
        'discount',
        'pay',
        'received',
        'payday',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'user_id', 'id');
    }
}
