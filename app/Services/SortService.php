<?php

namespace App\Services;

use App\Helpers\UploadImage;
use App\Repositories\SortRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Http\Request;

class SortService
{
    protected $sortRepository;

    public function __construct(SortRepository $sortRepository)
    {
        $this->sortRepository = $sortRepository;
    }

    public function getAll($store_id = null){

        if($store_id){
           return $this->sortRepository->getAll($store_id);
        } else {
           return $this->sortRepository->getAll();
        }
    }

    public function create(Request $request){

        // dd($request->all());

        try{

            if($request->initial_date > $request->final_date){
                return "Error";
            } else {

                $sort['description'] = $request->description;
                $sort['type'] = $request->type;
                $sort['store_id'] = $request->store_id;
                $sort['initial_date'] = $request->initial_date;
                $sort['final_date'] = $request->final_date;
                $sort['limite'] = $request->limite;

                if($request->hasFile('image') && $request->file('image')->isValid()){

                    $upload = new UploadImage;
                    $store['image'] = $upload->upload($request->image, 'sort');

                }

                $this->sortRepository->create($sort);

                return "Sorteio cadastrado com sucesso";
            }

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}