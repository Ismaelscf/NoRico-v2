<aside class="main-sidebar sidebar-dark-primary elevation-4 ponto-quente-backround-yellow">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('images/logo_ponto_quente.png')}}"
             alt="Logo Ponto Quente"
             width="100%">
        {{-- <span class="brand-text font-weight-light"></span> --}}
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
