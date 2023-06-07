<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
           SI<span>KKO</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @if (\Auth::user()->role == 'Pemilik')
                <li class="nav-item nav-category">Pemilik</li>
                <li class="nav-item {{ active_class(['pemilik/dashboard']) }}">
                    <a href="{{ url('pemilik/dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/user']) }}">
                    <a href="{{ url('pemilik/user') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">User</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/kamar']) }}">
                    <a href="{{ url('pemilik/kamar') }}" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Kamar</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/penghuni']) }}">
                    <a href="{{ url('pemilik/penghuni') }}" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Penghuni</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/tagihan']) }}">
                    <a href="{{ url('pemilik/tagihan') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Tagihan</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/faktur']) }}">
                    <a href="{{ url('pemilik/faktur') }}" class="nav-link">
                        <i class="link-icon" data-feather="corner-right-down"></i>
                        <span class="link-title">Pemasukan</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['pemilik/pengeluaran']) }}">
                    <a href="{{ url('pemilik/pengeluaran') }}" class="nav-link">
                        <i class="link-icon" data-feather="corner-left-up"></i>
                        <span class="link-title">Pengeluaran</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['penghuni/keuangan']) }}">
                    <a href="{{ url('pemilik/keuangan') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Keuangan</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['penghuni/keluhan']) }}">
                    <a href="{{ url('pemilik/keluhan') }}" class="nav-link">
                        <i class="link-icon" data-feather="minus-circle"></i>
                        <span class="link-title">Keluhan</span>
                    </a>
                </li>
            @endif
            <br>
            @if (\Auth::user()->role == 'Penghuni')
                <li class="nav-item nav-category">Penghuni</li>
                <li class="nav-item {{ active_class(['penghuni/dashboard']) }}">
                    <a href="{{ url('penghuni/dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['penghuni/tagihan']) }}">
                    <a href="{{ url('penghuni/tagihan') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Tagihan</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class(['penghuni/keluhan']) }}">
                    <a href="{{ url('penghuni/keluhan') }}" class="nav-link">
                        <i class="link-icon" data-feather="minus-circle"></i>
                        <span class="link-title">Keluhan</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
