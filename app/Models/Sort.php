<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'award',
        'type',
        'description',
        'image',
    ];

    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function winners(){
        return $this->hasMany(Winner::class, 'sort_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
