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
                    <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link"><i class="fa fa-th-large me-2"></i>Kategori Produk</a>
                    <a href="{{route('Product.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Daftar Produk</a>
                    <a href="{{route('customer.index')}}" class="nav-item nav-link active"><i class="fa fa-user-friends me-2"></i>Daftar Pelanggan</a>
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

            {{-- Title + Button  --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="ms-4 mt-4 text-dark">Manajemen Akun</h4>
            </div>
            {{-- End Title + Button --}}

             <!-- Recent Sales Start -->
             <div class="container-fluid pt-2 px-2">
                <div class="bg- justify-content-between rounded p-4" style="background-color: #ededed">
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 datatable" id="CustomerTable">
                            <thead>
                                <tr class="text-dark">
                                    <th class="text-center" scope="col">No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $id => $pc)
                                    <tr class="text-dark">
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $pc['nama'] }}</td>
                                        <td>{{ $pc['email'] }}</td>
                                        <td>{{ $pc['nohp'] }}</td>
                                        <td>{{ $pc['status'] }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    </div>
@endsection
