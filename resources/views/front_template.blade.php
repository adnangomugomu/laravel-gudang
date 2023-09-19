<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title', 'Aplikasi Belajar Laravel')</title>
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
        
        body {
            background-color: #caf2ff !important;
            background-image: url('{{ asset("awan.webp") }}');
            background-size: 200px 150px;
            background-position: 0 0;
            animation: moveClouds 60s linear infinite;
        }

        @keyframes moveClouds {
            to {
                background-position: 100% 0;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Gudang - Laravel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home mr-1"></i> Home</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('produk') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('produk') }}"><i class="fa fa-cube mr-1"></i> Produk</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about') }}"><i class="fa fa-user mr-1"></i> About</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('profil') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('profil') }}"><i class="fa fa-info-circle mr-1"></i> Profil</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('registrasi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('registrasi') }}">Registrasi Akun</a>
                    </li>
                </ul>
                <a href="{{ route('login.logout') }}" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i> Logout</a>
            </div>
        </div>
    </nav>
    <div class="container pb-4">
        <div class="d-flex justify-content-between" style="align-items: end;">
            <h5 class="mt-4 text-primary" style="text-decoration: underline;text-transform: uppercase;">@yield('header')</h5>
            @yield('tombol')
        </div>
        @hasSection('konten')
            <div class="card">
                <div class="card-body p-0 p-md-4">
                    @yield('konten')
                </div>
            </div>
        @endif
    </div>

    <div id="modal_custom" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px);">
        <div id="modal_custom_size" class="modal-dialog modal-xl">
            <div style="border: 0;" class="modal-content shadow1">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title mt-0 text-white">JUDUL</h5>
                    <button type="button" class="close" onclick="$('#modal_custom').modal('hide');">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, saepe esse sit nihil aperiam quae porro eveniet in recusandae consequatur reiciendis voluptatibus blanditiis magni! Aliquid ex minima distinctio at quod.
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('my_custom.js') . '?t=' . time() }}"></script>
    <!-- cdn select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('script')
</body>

</html>
