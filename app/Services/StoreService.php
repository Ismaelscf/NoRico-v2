<?php

namespace App\Services;

use App\Repositories\StoreRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Services\AddressService;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Helpers\UploadImage;
use App\Repositories\AddressRepository;
use App\Services\ActorService;
use App\Repositories\StoreEmployeeRepository;

class StoreService
{
    protected $storeRepository;
    
    protected $addressService;
    protected $addressRepository;
    protected $actorService;
    protected $storeEmployeeRepository;

    public function __construct(StoreRepository $storeRepository, AddressService $addressService, AddressRepository $addressRepository, ActorService $actorService, StoreEmployeeRepository $storeEmployeeRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->addressService = $addressService;
        $this->addressRepository = $addressRepository;
        $this->actorService = $actorService;
        $this->storeEmployeeRepository = $storeEmployeeRepository;
    }

    public function removeMask($value){
        $number = str_replace(".", "", $value);
        $number = str_replace(",", ".", $number);

        return $number;
    }

    public function remover_caracteres($texto){
        $texto = str_replace(".", "", $texto);
        $texto = str_replace(",", "", $texto);
        $texto = str_replace("-", "", $texto);
        $texto = str_replace("/", "", $texto);
        $texto = str_replace("(", "", $texto);
        $texto = str_replace(")", "", $texto);
        $texto = str_replace(" ", "", $texto);
        return $texto;
    }

    public function getAll(){
        return $this->storeRepository->getAll();
    }

    public function getAllActive(){
        return $this->storeRepository->getAllActive();
    }

    public function create(Request $request){

        try {
            $store['name'] = $request->name;
            $store['cnpj'] = $this->remover_caracteres($request->cnpj);
            $store['email'] = $request->email;
            $store['phone'] = $this->remover_caracteres($request->phone);
            $store['full_discount'] = $this->removeMask($request->full_discount);
            $store['percentage_discount'] = $this->removeMask($request->percentage_discount);
            $store['discount'] = false;
            $store['sort'] = false;
            $store['active'] = true;

            $address['street'] = $request->street;
            $address['number'] = $request->number;
            $address['complement'] = $request->complement;
            $address['district'] = $request->district;
            $address['city'] = $request->city;
            $address['state'] = $request->state;
            $address['type'] = 'comercial';

            if($request->discount){
                $store['discount'] = true;
            }

            if($request->sort){
                $store['sort'] = true;
            }

            if($request->hasFile('image') && $request->file('image')->isValid()){

                $upload = new UploadImage;
                $store['logo'] = $upload->upload($request->image, 'store');

            }

            $this->storeRepository->create($store);

            $storeCreated = $this->storeRepository->searchStore('cnpj', $store['cnpj']);

            $address['store_id'] = $storeCreated[0]->id;

            $this->addressRepository->create($address); //Metodo de cadastrar endereço

            $manager = json_decode ($request->manager);

            $storeEmployee['store_id'] = $storeCreated[0]->id;
            $storeEmployee['user_id'] = $manager->user_id;
            $storeEmployee['function'] = $manager->function;
            $storeEmployee['active'] = 1;   

            $this->storeEmployeeRepository->create($storeEmployee);

            // $this->addressService->create($storeCreated->id, $address);
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function searchStore($field, $value){

        try {
           
            $store = $this->storeRepository->searchStore($field, $value);

            $store = $store[0];

            return $store;

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function edit($request){
        try {
            $store = $this->storeRepository->searchStore('id', $request->id);

            $store = $store[0];

            $store->name = $request->name;
            $store->cnpj = $this->remover_caracteres($request->cnpj);
            $store->email = $request->email;
            $store->phone = $this->remover_caracteres($request->phone);
            $store->full_discount = $this->removeMask($request->full_discount);
            $store->percentage_discount = $this->removeMask($request->percentage_discount);
            $store->discount = false;
            $store->sort = false;
            $store->active = $request->active;

            $address['street'] = $request->street;
            $address['number'] = $request->number;
            $address['complement'] = $request->complement;
            $address['district'] = $request->district;
            $address['city'] = $request->city;
            $address['state'] = $request->state;
            $address['type'] = 'comercial';

            $address = (object) $address;

            if($request->discount){
                $store['discount'] = true;
            }

            if($request->sort){
                $store['sort'] = true;
            }

            if($request->hasFile('image') && $request->file('image')->isValid()){

                $upload = new UploadImage;
                $store['logo'] = $upload->upload($request->image, 'store');

            }

            // dd($store);
            $this->storeRepository->edit($store);

            
            $this->addressService->edit($address, $store->id);

            return $store;
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function inactive($id){

        try {

            $search = $this->storeRepository->searchStore('id', $id);

            if($search[0]->id == $id){

                $store = $search[0];
                $store->active = !$search[0]->active;

                return $this->storeRepository->inactive($store);
            } else {
                $error = 'Loja não encontrada';
                return $error;
            }

        }  catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getAllManager(){
        // $managerStore = $this->storeEmployeeRepository->getAllManager();
        $allManager = $this->actorService->getAllManager();

        // dd($allManager);

        $manager = array();
        foreach($allManager as $avaliable){
            if($avaliable->user->employee == null){
                array_push($manager, $avaliable);
            }
        }

        

        // if(count($managerStore) == 0){
        //     foreach($allManager as $avaliable){
        //         array_push($manager, $avaliable);
        //     }
        // }
        // else {
        //     foreach($managerStore as $store){
        //         $manager = array_filter($allManager, function($value) use ($store){
        //             if($value['user_id'] != $store['user_id']){
        //                 return $value;
        //             }
        //         });
        //     }
        // }
        
        // dd($manager);
        return $manager;
    }
}