@extends('layouts.app')
<?php
$user = Auth::user();
$permition = $user->actors->function;
if($permition != 'amin'){
    dd('sem permissão');
    // return redirect('/')->with('result', 'Você não tem permissão para acessar essa pagina');
}
?>

@push('script-fisrt')
@endpush

@section('content')
<section class="content">
        <div class="row justify-content-md-center">
        <div class="col-md-8  card card-primary card-outline">
            <div class="card-body box-profile">
            <div class="text-center">
            @if(isset($user->photo))
                <img class="profile-user-img img-fluid img-circle" src="{{asset($user->photo)}}">
            @endif
            </div>
            <h3 class="profile-username text-center">{{$user->name}}</h3>
            <p class="text-muted text-center">Email: {{$user->email}}</p>
            <p class="text-muted text-center">Tefefone: {{$user->phone}}</p>
            
            <h1 href="#" class="btn btn-primary btn-block"><b>Vencedor</b></h1>
            </div>

            </div>
        </div>
</section>
@endsection