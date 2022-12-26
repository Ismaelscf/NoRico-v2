<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sort;
use App\Models\User;

class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sort_id',
    ];

    public function sort(){
        return $this->belongsTo(Sort::class, 'sort_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
