@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    
    <script>
        console.log('teste');
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
            <div class="col-md-12 col-sm-12">
                @include('sort.create')
            </div>
    
            {{-- <div class="col-md-12 col-sm-12">
                @include('sort.storeList')
            </div> --}}
        </div>
    </section>
@endsection