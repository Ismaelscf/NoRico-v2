<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quota;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'quota_id',
        'user_id',
        'seller_id',
        'price',
        'due_date',
        'payday',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function quota(){
        return $this->belongsTo(Quota::class, 'quota_id', 'id');
    }
}
