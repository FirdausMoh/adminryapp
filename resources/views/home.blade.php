@extends('layouts.app')
@section('content')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="" src="{{ Vite::asset('resources/images/LOGO.png') }}" alt="" style="width: 180px; height: 130px;">
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('home')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Data Pemesanan</a>
                    <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link"><i class="fa fa-th-large me-2"></i>Kategori Produk</a>
                    <a href="{{route('Product.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Daftar Produk</a>
                    <a href="{{route('customer.index')}}" class="nav-item nav-link"><i class="fa fa-user-friends me-2"></i>Daftar Pelanggan</a>
                    <a href="{{route('transaction.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Data Pembayaran</a>
                    <a href="{{route('company.index')}}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profil</a>
                    <a href="{{ route('logout') }}" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"
                     onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        </i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>

        <!-- Sidebar End -->

        <div class="content">
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto me-3">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="rounded-circle me-lg-2 fa fa-user me-2"></i>
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </div>
            </nav>
             <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="mb-0">Data Pembelian</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">No</th>
                                    <th scope="col">Timestamp</th>
                                    <th  scope="col">Nama</th>
                                    <th  scope="col">Email</th>
                                    <th  scope="col">Pesan</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $id => $pc)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pc['timestamp'] }}</td>
                                        <td>{{ $pc['Nama'] }}</td>
                                        <td>{{ $pc['userEmail'] }}</td>
                                        <td>{{ $pc['Pesan'] }}</td>
                                        <td>
                                            @for ($i = 0; $i < count($pc); $i++)
                                                @if (isset($pc['namaproduct_' . $i]))
                                                    {{ $pc['namaproduct_' . $i] }}
                                                    @if ($i < count($pc) - 1)

                                                    -
                                                    @endif
                                                @endif
                                            @endfor
                                        </td>
                                        <td>
                                            @for ($i = 0; $i < count($pc); $i++)
                                                @if (isset($pc['quantity_' . $i]))
                                                    {{ $pc['quantity_' . $i] }}
                                                    @if ($i < count($pc) - 1)
                                                        -
                                                    @endif
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $pc['totalHarga'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/app.js') }}"></script>
@endsection
