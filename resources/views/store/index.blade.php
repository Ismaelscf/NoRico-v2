@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @include('store.create')
            </div>
    
            <div class="col-md-12 col-sm-12">
                @include('store.storeList')
            </div>
        </div>
    </section>    
    
@endsection