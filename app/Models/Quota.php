<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Installment;

class Quota extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'initial_date',
        'final_date',
        'customer_limit',
        'status',
    ];

    public function installments(){
        return $this->hasMany(Installment::class, 'quota_id', 'id');
    }
}
