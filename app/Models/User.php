<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Installment;
use App\Models\Address;
use App\Models\Sale;
use App\Models\StoreEmployee;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'payday',
        'cpf',
        'phone',
        'photo',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function installments(){
        return $this->hasMany(Installment::class, 'user_id', 'id');
    }

    public function installments_seller(){
        return $this->hasMany(Installment::class, 'seller_id', 'id');
    }

    public function actors(){
        return $this->hasOne(Actor::class, 'user_id', 'id');
    }

    public function address(){
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'user_id', 'id');
    }

    public function employee(){
        return $this->hasOne(StoreEmployee::class, 'user_id', 'id');
    }
}
