@extends('layouts.app')
@section('content')
    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#TransactionTable').DataTable();
            });
        </script>
    @endpush
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
                    <a href="{{route('customer.index')}}" class="nav-item nav-link"><i class="fa fa-user-friends me-2"></i>Daftar Pelanggan</a>
                    {{-- <a href="{{ route('transaction.create', AppHelper::transaction_code())}}" class="nav-item nav-link"><i class="fa fa-cash-register me-2"></i>Transaksi</a> --}}
                    <a href="{{route('transaction.index')}}" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Data Pembayaran</a>
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
            <nav class="navbar navbar-expand bg- navbar-sticky-top px-4 py-0" style="background-color: #01807e">
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

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="ms-4 mt-4 text-dark">Bukti Transfer</h2>
                {{-- <div class="ms-4 mt-4">
                    <ul class="list-inline mb-0 float-end">
                        <li class="list-inline-item">
                            <a href="{{ route('transaction.exportExcelTransaction') }}" class="btn btn-outline-success">
                                <i class="bi bi-download me-1"></i> to Excel
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('transaction.exportPdfTransaction') }}" class="btn btn-outline-danger">
                                <i class="bi bi-download me-1"></i> to PDF
                            </a>
                        </li>
                        <li class="list-inline-item ">|</li>
                        <li class="list-inline-item ">
                            <a href="{{ route('transaction.create', AppHelper::transaction_code()) }}"
                                class="me-4 btn btn-success">
                                <i class="fas fa-plus"></i> Transaksi Baru</a>
                        </li>
                    </ul>
                </div> --}}
                {{-- <a href="{{route('customer.create')}}" class="me-4 mt-4 btn btn-success"><i class="fas fa-plus"></i> Tambahkan Pelanggan</a> --}}
            </div>

            <div class="container-fluid pt-4 px-4">

                <div class="bg- justify-content-between rounded p-4" style="background-color: #ededed">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">No</th>
                                <th scope="col">Timestamp</th>
                                <th  scope="col">Nama</th>
                                <th  scope="col">Email</th>
                                <th  scope="col">Alamat</th>
                                {{-- <th  scope="col">Pesan</th> --}}
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Foto Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $id => $pc)
                                <tr class="text-dark">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pc['timestamp'] }}</td>
                                    <td>{{ $pc['Nama'] }}</td>
                                    <td>{{ $pc['userEmail'] }}</td>
                                    <td>{{ $pc['Alamat'] }}</td>
                                    {{-- <td>{{ $pc['Pesan'] }}</td> --}}
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

                                    <td>
                                        @if(isset($pc['imageUrl']))
                                            <img src="{{ $pc['imageUrl'] }}" alt="Foto" style="width: 150px; height: 180px;">
                                        @else
                                            <p>No Image</p>
                                        @endif
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="imageModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="modalImage">
                    <style>
                        /* Style untuk modal */
                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 1000;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgba(0,0,0,0.9);
                        }
                    
                        .modal-content {
                            margin: auto;
                            display: block;
                            max-width: 90%;
                            max-height: 90%;
                        }
                    
                        .close {
                            position: absolute;
                            top: 15px;
                            right: 35px;
                            color: #fff;
                            font-size: 40px;
                            font-weight: bold;
                            transition: 0.3s;
                        }
                    
                        .close:hover,
                        .close:focus {
                            color: #bbb;
                            text-decoration: none;
                            cursor: pointer;
                        }
                    </style>
                    <script>
                        // Get the modal
                        var modal = document.getElementById('imageModal');
                    
                        // Get the image and insert it inside the modal - use its "alt" text as a caption
                        var modalImg = document.getElementById("modalImage");
                        
                        // Loop through each image in the table
                        var images = document.querySelectorAll('img[src]');
                        images.forEach(function(imgElement) {
                            imgElement.onclick = function() {
                                modal.style.display = "block";
                                modalImg.src = this.src;
                            }
                        });
                    
                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                    
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                    </script>
                    
                </div>
            </div>
        </div>

    </div>
@endsection
