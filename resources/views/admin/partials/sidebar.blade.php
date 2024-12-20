<aside id="sidebar-wrapper">
    <div class="sidebar-brand mb-5">
        <a href="{{ url('/') }}">
            <img width="100" src="{{ asset('assets/images/logo/Clinic.png') }}" alt="">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}">
            <img width="40" src="{{ asset('assets/images/logo/Clinic.png') }}" alt="">
        </a>
    </div>
    <ul class="sidebar-menu">
            <li {{ is_nav_active('dashboard') }}>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li {{ is_nav_active('user') }}>
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li {{ is_nav_active('menu') }}>
                <a class="nav-link" href="{{ route('admin.menu.index') }}">
                    <i class="fas fa-utensils"></i> <span>Menu</span>
                </a>
            </li>
            <li {{ is_nav_active('table') }}>
                <a class="nav-link" href="{{ route('admin.table.index') }}">
                    <i class="fas fa-sort-numeric-down"></i> <span>Tables</span>
                </a>
            </li>
        <li {{ is_nav_active('reservation') }}>
            <a class="nav-link" href="{{ route('admin.reservation.index') }}">
                <i class="fas fa-scroll"></i> <span>Reservation</span>
            </a>
        </li>
        <li {{ is_nav_active('supplier') }}>
            <a class="nav-link" href="{{ route('admin.supplier.index') }}">
                <i class="fas fa-users"></i> <span>Supplier</span>
            </a>
        </li>
        <li class="dropdown {{ is_drop_active('produk') }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-box"></i> <span>Produk</span>
            </a>
            <ul class="dropdown-menu">
                        <li {{ is_nav_active('list') }}>
                            <a class="nav-link" href="{{ route('admin.product_list.index') }}">
                                <i class="far fa-circle"></i> List Produk
                            </a>
                        </li>
                        <li {{ is_nav_active('stok') }}>
                            <a class="nav-link" href="{{ route('admin.barang.stok.index') }}">
                                <i class="far fa-circle"></i> Stok Produk
                            </a>
                        </li>
                        {{-- <li {{ is_nav_active('masuk') }}>
                            <a class="nav-link" href="{{ route('admin.barang.masuk.index') }}">
                                <i class="far fa-circle"></i> Barang Masuk
                            </a>
                        </li> --}}
                        <li {{ is_nav_active('kelola') }}>
                            <a class="nav-link" href="{{ route('admin.product_in.index') }}">
                                <i class="far fa-circle"></i> Produk Masuk
                            </a>
                        </li>
                        <li {{ is_nav_active('keluar') }}>
                            <a class="nav-link" href="{{ route('admin.barang.keluar.index') }}">
                                <i class="far fa-circle"></i> Barang Keluar
                            </a>
                        </li>
            </ul>
        </li>
        <li class="dropdown {{ is_drop_active('laporan') }}" >
            <a class="nav-link has-dropdown" href="#">
                <i class="fas fa-folder-open"></i> <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li {{ is_nav_active('masuk') }}>
                    <a class="nav-link" href="{{ route('admin.laporan.masuk.index') }}">
                        <i class="far fa-circle"></i> Barang Masuk
                    </a>
                </li>
                <li {{ is_nav_active('keluar') }}>
                    <a class="nav-link" href="{{ route('admin.laporan.keluar.index') }}">
                        <i class="far fa-circle"></i> Barang Keluar
                    </a>
                </li>
                <li {{ is_nav_active('transaksi') }}>
                    <a class="nav-link" href="{{ route('admin.laporan.transaksi.index') }}">
                        <i class="far fa-circle"></i> Transaksi
                    </a>
                </li>
            </ul>
        </li>
            <li {{ is_nav_active('orders') }}>
                <a class="nav-link" href="{{ route('admin.chef.index') }}">
                    <i class="fas fa-utensils"></i> <span>Orders</span>
                </a>
            </li>
            <li {{ is_nav_active('keluar') }}>
                <a class="nav-link" href="{{ route('admin.barang.keluar.index') }}">
                    <i class="fas fa-box"></i> <span>Barang Keluar</span>
                </a>
            </li>
            <li {{ is_nav_active('reservation') }}>
                <a class="nav-link" href="{{ route('admin.reservation.index') }}">
                    <i class="fas fa-scroll"></i> <span>Reservation</span>
                </a>
            </li>
            <li {{ is_nav_active('transaksi') }}>
                <a class="nav-link" href="{{ route('admin.laporan.transaksi.index') }}">
                    <i class="fas fa-money-bill"></i> <span>Transaksi</span>
                </a>
            </li>
    </ul>
</aside>
