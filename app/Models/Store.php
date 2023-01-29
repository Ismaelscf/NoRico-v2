<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\StoreEmployee;
use App\Models\Sale;
use App\Models\Sort;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
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
        return $this->hasOne(Address::class, 'store_id', 'id');
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


    public function formatar_document($document){
        if(strlen($document) <= 11){
            return $this->formatar_cpf($document);
        }
            return $this->formatar_cnpj($document);
    }

    public function formatar_cpf($cpf){
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
    }

    public function formatar_cnpj($cnpj){
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj);
    }

    public function formatar_phone($phone){
        return preg_replace("/(\d{2})(\d{5})(\d{4})/", "(\$1) \$2-\$3", $phone);
    }
}
