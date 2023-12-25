@extends('layouts.app')
@section('content')
{{-- @push('scripts')
<script type="module">
    $(document).ready(function() {
        $('#CustomerTable').DataTable();
        $(".datatable").on("click", ".btn-delete", function (e) {
            e.preventDefault();

            var form = $(this).closest("form");
            var name = $(this).data("name");

            Swal.fire({
                title: "Yakin Ingin Menghapus Pelanggan Bernama\n" + name + "?",
                text: "Data Akan Terhapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: "bg-primary",
                confirmButtonText: "Yakin",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
 });
</script>
@endpush --}}
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
                    <a href="{{route('home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dasbor</a>
                    <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link"><i class="fa fa-th-large me-2"></i>Kategori Prduk</a>
                    <a href="{{route('Product.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Produk</a>
                    <a href="{{route('customer.index')}}" class="nav-item nav-link active"><i class="fa fa-user-friends me-2"></i>Pelanggan</a>
                    <a href="{{ route('transaction.create', AppHelper::transaction_code())}}" class="nav-item nav-link"><i class="fa fa-cash-register me-2"></i>Transaksi</a>
                    <a href="{{route('transaction.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Penjualan</a>
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

            {{-- Title + Button  --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="ms-4 mt-4">Manajemen Pembeli</h4>
                <div class="ms-4 mt-4">
                    <ul class="list-inline mb-0 float-end">
                        <li class="list-inline-item">
                            <a href="{{ route('customer.exportExcelCustomer') }}" class="btn btn-outline-success">
                                <i class="bi bi-download me-1"></i> to Excel
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('customer.exportPdfCustomer') }}" class="btn btn-outline-danger">
                                <i class="bi bi-download me-1"></i> to PDF
                            </a>
                        </li>
                        <li class="list-inline-item " >|</li>
                        <li class="list-inline-item ">
                            <a href="{{ route('customer.create') }}" class="me-4 btn btn-success">
                                <i class="fas fa-plus"></i> Tambahkan Pelanggan</a>
                        </li>
                    </ul>
                </div>
                {{-- <a href="{{route('customer.create')}}" class="me-4 mt-4 btn btn-success"><i class="fas fa-plus"></i> Tambahkan Pelanggan</a> --}}
            </div>
            {{-- End Title + Button --}}

             <!-- Recent Sales Start -->
             <div class="container-fluid pt-2 px-2">
                <div class="bg-secondary justify-content-between rounded p-4">
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 datatable" id="CustomerTable">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th  scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">NO.Tel</th>
                                    <th scope="col">Pesan</th>
                                    <th scope="col">Foto</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $id => $pc)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pc['Nama'] }}</td>
                                        <td>{{ $pc['Alamat'] }}</td>
                                        <td>{{ $pc['Email'] }}</td>
                                        <td>{{ $pc['NoTelpon'] }}</td>
                                        <td>{{ $pc['Pesan'] }}</td>
                                        <td>
                                            <img src="{{ $pc['image'] }}" alt="Foto" style="width: 100%; height: 100%;">
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
