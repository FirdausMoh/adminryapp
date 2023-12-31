@extends('layouts.app')
@section('content')


    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-navbar-">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="" src="{{ Vite::asset('resources/images/JAAA.png') }}" alt="" style="width: 210px; height: 190px;">
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Data Pemesanan</a>
                    <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link active"><i class="fa fa-th-large me-2"></i>Kategori Produk</a>
                    <a href="{{route('Product.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Daftar Produk</a>
                    <a href="{{route('customer.index')}}" class="nav-item nav-link"><i class="fa fa-user-friends me-2"></i>Daftar Pelanggan</a>
                    {{-- <a href="{{ route('transaction.create', AppHelper::transaction_code())}}" class="nav-item nav-link"><i class="fa fa-cash-register me-2"></i>Transaksi</a> --}}
                    <a href="{{route('transaction.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Data Pembayaran</a>
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
            <nav class="navbar navbar-expand bg- navbar- sticky-top px-4 py-0" style="background-color: #01807e">
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

                    <div class="d-flex align-items-center justify-content-between m-4">
                        <h3 class="ms-4 mt-4" style="color: black">Manajemen Kategori Produk</h3>
                        <div class="ms-4 mt-4">
                            <ul class="list-inline mb-0 float-end">
                                <li class="list-inline-item">
                                    <a href="{{ route('ProductCategories.create') }}" class="me-4 btn btn-success">
                                        <i class="fas fa-plus"></i> Tambahkan Produk
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                        <!-- Recent Sales Start -->
                        <div class="container-fluid pt-2 px-4" >
                            <div style="background-color: #ededed" class="bg- justify-content-between rounded p-3">
                                <div class="table-responsive">
                                    <table class="table text-start align-middle table-bordered table-hover mb-0 datatable" id="ProductCategoryTable">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col" style="width: 10%;">ID</th>
                                                <th scope="col" style="width: 80%;">Kategori Produk</th>
                                                <th scope="col" style="width: 10%;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- tampil data --}}
                                            @foreach($productcategories as $id => $pc)
                                            <tr style="color: rgb(0, 0, 0)">
                                                <td >{{ $loop->iteration }}</td>
                                                <td>{{ $pc['namakategori'] }}</td>

                                                <td>
                                                    <form action="{{route('ProductCategories.destroy', ['ProductCategory' => $id])}}" method="POST">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-sm btn-danger btn-delete"
                                                            data-name="">
                                                            <i class="bi-trash"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
