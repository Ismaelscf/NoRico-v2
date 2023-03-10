<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')
<?php
// $user = Auth::user();
// $permition = $user->actors->function;
// if($permition != 'amin' && $permition != 'cliente'){
//     dd('sem permissão');
//     // return redirect('/')->with('result', 'Você não tem permissão para acessar essa pagina');
// }
?>

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                // width: 'resolve',
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@section('content')
@if($permition == 'admin' || $permition == 'cliente' || $permition == 'vendedor')
    <section class="content">
        <div class="row">

            @if(isset($result))
                <div class="alert alert-warning" role="alert">
                    {{ $result }}
                </div>
            @endif

            @if(session('result'))
                <div class="alert alert-warning" role="alert">
                    {{ session('result') }}
                </div>
            @endif

            
            <div class="col-md-12 col-sm-12">
                @if($permition == 'admin')
                    @include('invoice.totalizers')
                @endif
            </div>

            <div class="col-md-12 col-sm-12">
                @if($permition == 'admin')
                    @include('invoice.create')
                @endif
            </div>
    
            <div class="col-md-12 col-sm-12">
                @include('invoice.invoiceList')
            </div>
        </div>
    </section>    
@endif
@endsection