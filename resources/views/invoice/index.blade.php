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
                @include('invoice.create')
            </div>
    
            <div class="col-md-12 col-sm-12">
                @include('invoice.invoiceList')
            </div>
        </div>
    </section>    
    
@endsection