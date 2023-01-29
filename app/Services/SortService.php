<?php

namespace App\Services;

use App\Helpers\UploadImage;
use App\Models\Sort;
use App\Repositories\SortRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Http\Request;
use DateTime;

class SortService
{
    protected $sortRepository;
    protected $userRepository;

    public function __construct(SortRepository $sortRepository, UserRepository $userRepository)
    {
        $this->sortRepository = $sortRepository;
        $this->userRepository = $userRepository;
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }

    public function getAll($store_id = null){

        if($store_id){
            $sorts = $this->sortRepository->getAll($store_id);
        } else {
            $sorts = $this->sortRepository->getAll();
        }

        foreach ($sorts as $sort){
            $initial_date = new DateTime($sort->initial_date);
            $final_date = new DateTime($sort->final_date);
            $draw_date = new DateTime($sort->draw_date);
            
            $sort->initial_date = $initial_date->format('d/m/Y');
            $sort->final_date = $final_date->format('d/m/Y');
            $sort->draw_date = $draw_date->format('d/m/Y');
        }

        // dd($sorts[2]->store->name);

        return $sorts;
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
                $sort['draw_date'] = $request->draw_date;
                $sort['limit'] = $this->removeMask($request->limit);
                $sort['active'] = true;

                if($request->hasFile('image') && $request->file('image')->isValid()){

                    $upload = new UploadImage;
                    $sort['image'] = $upload->upload($request->image, 'sort');

                }

                $this->sortRepository->create($sort);

                return "Sorteio cadastrado com sucesso";
            }

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function searchSort($field, $value){

        try {
           
            $sort = $this->sortRepository->searchSort($field, $value);

            $sort = $sort[0];

            return $sort;

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function edit(Request $request){
        try {
            $sort = $this->sortRepository->searchSort('id', $request->id);

            $sort = $sort[0];

            $sort->description = $request->description;
            $sort->type = $request->type;
            $sort->store_id = $request->store_id;
            $sort->initial_date = $request->initial_date;
            $sort->final_date = $request->final_date;
            $sort->draw_date = $request->draw_date;
            $sort->limit = $this->removeMask($request->limit);

            if($request->hasFile('image') && $request->file('image')->isValid()){

                $upload = new UploadImage;
                $sort['image'] = $upload->upload($request->image, 'sort');

            }

            $this->sortRepository->edit($sort);

            return "Alterações Salvas com sucesso";
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function inactive($id){

        try {

            $search = $this->sortRepository->searchSort('id', $id);

            if($search[0]->id == $id){

                $sort = $search[0];
                $sort->active = !$search[0]->active;

                return $this->sortRepository->inactive($sort);
            } else {
                $error = 'Loja não encontrada';
                return $error;
            }

        }  catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function winner($dados){
        $sort = $this->sortRepository->search($dados->id);
        $winner = json_decode($dados->users);
        $winner = $winner[array_rand($winner)];
        $winner = $this->userRepository->search($winner);

        $sort->award = $winner->id;
        $this->sortRepository->edit($sort);
        
        return $sort;
    }
    public function getAllSortActive(){
        return $this->sortRepository->getAllSortActive();
    }
}