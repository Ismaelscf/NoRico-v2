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

class StoreService
{
    protected $storeRepository;
    
    protected $addressService;
    protected $addressRepository;

    public function __construct(StoreRepository $storeRepository, AddressService $addressService, AddressRepository $addressRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->addressService = $addressService;
        $this->addressRepository = $addressRepository;
    }

    public function getAll(){
        return $this->storeRepository->getAll();
    }

    public function create(Request $request){

        // dd($request, 'Service');

        try {
            $store['name'] = $request->name;
            $store['cnpj'] = $request->cnpj;
            $store['email'] = $request->email;
            $store['phone'] = $request->phone;
            $store['full_discount'] = $request->full_discount;
            $store['percentage_discount'] = $request->percentage_discount;
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
            $store->cnpj = $request->cnpj;
            $store->email = $request->email;
            $store->phone = $request->phone;
            $store->full_discount = $request->full_discount;
            $store->percentage_discount = $request->percentage_discount;
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
}