<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    @if (Auth::user()->position === 'admin' || Auth::user()->position === 'produksi')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Produksi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Form:</h6>
                    <a class="collapse-item" href="{{ route('jadwal-produksi') }}">Jadwal Produksi</a>
                    <a class="collapse-item" href="{{ route('barang-selesai-produksi') }}">Barang Selesai Produksi</a>
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->position === 'admin' || Auth::user()->position === 'sales')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-cog"></i>
                <span>Sales</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Form:</h6>
                    <a class="collapse-item" href="{{ route('surat-jalan') }}">Surat Jalan</a>
                    <a class="collapse-item" href="{{ route('jadwal-produksi-sales') }}">Jadwal Produksi</a>
                    <a class="collapse-item" href="{{ route('spk') }}">Pembuatan Spk</a>
                    {{-- <a class="collapse-item" href="">Barang Selesai</a> --}}
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->position === 'admin' || Auth::user()->position === 'purchasing')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                aria-expanded="true" aria-controls="collapseFour">
                <i class="fas fa-fw fa-cog"></i>
                <span>Purchasing </span>
            </a>
            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Form:</h6>
                    <a class="collapse-item" href="{{ route('popurchasing') }}">Pembuatan PO</a>
                    <a class="collapse-item" href="{{ route('receiving-barang') }}">Receiving Barang</a>
                    <a class="collapse-item" href="{{ route('laporan-stock-purchasing') }}">Laporan Barang</a>
                </div>
            </div>
        </li>
    @endif


    @if (Auth::user()->position === 'admin' || Auth::user()->position === 'mpic/ppic')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                aria-expanded="true" aria-controls="collapseSix">
                <i class="fas fa-fw fa-cog"></i>
                <span>MPIC</span>
            </a>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Form:</h6>
                    <a class="collapse-item" onclick="return confirm('Kopi dulu dong')">Jadwal Produksi</a>
                    <a class="collapse-item" onclick="return confirm('Kopi dulu dong')" >Barang Selesai</a>
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->position === 'admin' || Auth::user()->position === 'warehouse')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
                aria-expanded="true" aria-controls="collapseSeven">
                <i class="fas fa-fw fa-cog"></i>
                <span>Warehouse </span>
            </a>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Form:</h6>
                    <a class="collapse-item" href="{{ route('barang-masuk') }}">Barang Masuk</a>
                    <a class="collapse-item" href="{{ route('barang-keluar') }}">Barang Keluar</a>
                    <a class="collapse-item" href="{{ route('warehouse-laporan-stock-barang') }}">Laporan Stock
                        Barang</a>
                </div>
            </div>
        </li>
    @endif

    @if (Auth::user()->position === 'admin')
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Customer</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('barang') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Barang</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('supplier') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Supplier</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidebar-heading">
            Register Pegawai
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register-user') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Register Akun</span></a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
