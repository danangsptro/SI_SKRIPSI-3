@extends('masterBackend')
@section('title', 'Admin | Dashboard')

@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="text-transform: uppercase; font-weight:bold">Dashboard</h1>

        </div>
        <div class=" shadow jumbotron jumbotron-fluid" style="background: black">
            <div class="container">
                <h1 class=" text-white" style="text-transform:uppercase; font-weight:bold">Selamat Datang,
                    {{ Auth::user()->position }} 👋

                </h1>
                <p class="lead text-warning" style="font-weight: bold">SISTEM SUPPLY CHAN UNTUK PRODUKSI BARANG DI
                    PT.ARTHAWENA SAKTI GEMILANG.</p>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Data Produksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $produksi->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Data Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sales->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Data Purchasing</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $purchasing->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Data Warehouse</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $warehouse->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
