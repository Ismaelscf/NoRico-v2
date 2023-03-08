<?php
$permition = Auth::user()->actors->function
?>
@extends('layouts.app')

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
@if($permition == 'admin')
    <section class="content">
        <div class="row">

            @if(isset($result) && $result == 'Error')
                <div class="alert alert-danger" role="alert">
                    Erro, A data final não pode anteceder a data inicial. Sorteio Não cadastrado
                </div>
            @elseif(isset($result) && $result != null)
                <div class="alert alert-success" role="alert">
                    {{ $result }}
                </div>
            @endif

            @if(session('result'))
                <div class="alert alert-warning" role="alert">
                    {{ session('result') }}
                </div>
            @endif
            

            <div class="col-md-12 col-sm-12">
                @include('sort.create')
            </div>
    
            <div class="col-md-12 col-sm-12">
                @include('sort.sortList')
            </div>
        </div>
    </section>
@endif
@endsection