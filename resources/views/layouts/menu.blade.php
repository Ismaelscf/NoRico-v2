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
