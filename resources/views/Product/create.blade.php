@extends('layouts.app')
@section('content')
<div class="container-fluid position-relative d-flex p-0">
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-navbar-dark">
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="" src="{{ Vite::asset('resources/images/JAAA.png') }}" alt="" style="width: 210px; height: 190px;">
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="{{route('home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Data Pemesanan</a>
                <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link"><i class="fa fa-th-large me-2"></i>Kategori Produk</a>
                <a href="{{route('Product.index')}}" class="nav-item nav-link active"><i class="fa fa-shopping-cart me-2"></i>Daftar Produk</a>
                <a href="{{route('customer.index')}}" class="nav-item nav-link"><i class="fa fa-user-friends me-2"></i>Daftar Pelanggan</a>
                {{-- <a href="{{ route('transaction.create', AppHelper::transaction_code())}}" class="nav-item nav-link"><i class="fa fa-cash-register me-2"></i>Transaksi</a> --}}
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
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0" >
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
            <h4 class="ms-4 mt-4 text-dark">Tambahkan Produk</h4>
        </div>
        {{-- End Title + Button --}}

        <div class="container-fluid pt-4 px-4">
            <div class="bg- rounded p-4" style="background-color: #ededed">
                <form action="{{route('Product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row" >
                        <div class="col-md-12 mb-3" >
                            <label for="product_code" class="form-label" >Kode Produk</label>
                            <input type="text" class="form-control  @error('product_code') is-invalid @enderror" name="product_code" id="product_code" value="{{ old('product_code') }}" placeholder="Masukan Kode Produk" style="background-color:  #ededed">
                            @error('product_code')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label" >Nama Produk</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="namaproduct" id="namaproduct" value="{{ old('name') }}" placeholder="Masukan Nama Produk" style="background-color:  #ededed">
                            @error('name')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="kategori" class="form-label">Kategori Produk <br/>
                        </label>
                        <select class="form-control form-select-sm" aria-label="Small select example" style="width: 90%" id="kategoriproduct" name="kategoriproduct" style="background-color:  #ededed">
                            <option selected>Pilih Kategori Produk</option>
                            @foreach($productCategories as $categoryId => $category)
                                <option value="{{ $categoryId }}">{{ $category['namakategori'] }} </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Masukan harga Produk" style="background-color:  #ededed">
                            @error('harga')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" name="gambar" id="gambar" style="background-color:  #ededed">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label ">Deskripsi Produk</label>
                            <textarea type="file" class="form-control" name="deskripsiproduct" id="deskripsiproduct" style="background-color:  #ededed"></textarea>
                        </div>
                        <div class="col-md-6 d-grid">
                            <a href="{{route('Product.index')}}" class="btn btn-danger btn-lg mt-3">Batal Tambahkkan Produk</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-success btn-lg mt-3">Tambahkan Produk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
