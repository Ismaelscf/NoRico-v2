<!-- need to remove -->
<?php
    $permissao = Auth::user()->function ;
?>
@if( $permissao == "Administrator")
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('store.index') }}" class="nav-link">
        <i class="nav-icon fas fa-store"></i>
        <p>Lojas</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.home') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Clientes</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('quotas.index') }}" class="nav-link">
        <i class="nav-icon fas fa-barcode"></i>
        <p>Planos</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('installment.index') }}" class="nav-link">
        <i class="nav-icon fas fa-barcode"></i>
        <p>Acompanhar</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('sort.index') }}" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Sorteios</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('sales.index') }}" class="nav-link">
        <i class="nav-icon fas fa-credit-card"></i>
        <p>Vendas</p>
    </a>
</li>
