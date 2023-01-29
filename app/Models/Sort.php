<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Winner;
use App\Models\User;

class Sort extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'award',
        'type',
        'description',
        'image',
        'initial_date',
        'final_date',
        'draw_date',
        'limit',
        'active'
    ];

    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function winners(){
        return $this->hasMany(Winner::class, 'sort_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'award', 'id');
    }
}
