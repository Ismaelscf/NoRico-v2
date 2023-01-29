<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quota;
use App\Models\installment;
use App\Models\User;

class UserQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quota_id',
        'active',
        'initial_date',
        'final_date'
    ];

    public function quota(){
        return $this->belongsTo(Quota::class, 'quota_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function installments(){
        return $this->hasMany(installments::class, 'user_quotas_id', 'id');
    }
}
