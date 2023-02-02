{{-- {{ dd($result); }} --}}
@extends('layouts.app')

@push('script-fisrt')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')


    <section class="content">
        <div class="row">

            @if(session('result'))
                <div class="alert alert-warning" role="alert">
                    {{ session('result') }}
                </div>
            @endif

            {{-- @switch(Auth::user()->actors->function)
                @case('admin')
                    @include('home.admin')
                    @break
                @case('vendedor')
                @include('home.vendedor')
                    @break
                @case('cliente')
                    @include('home.cliente')
                    @break
                @default
                    @include('home.lojista_gerente')
            @endswitch --}}
            @include('home.cliente')

            {{-- <div class="col-md-12">
                <div class="card" style="position: relative; left: 0px; top: 0px;">
                    <div class="card-header ui-sortable-handle bg-gray-dark" style="cursor: move;">
                        <h3 class="card-title">Home</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="card-body"></div>

                    <div class="card-footer">
                    </div>
                </div>
            </div> --}}

        </div>

    </section>
    
@endsection