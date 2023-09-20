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
            background-image: url('{{ asset('awan.webp') }}');
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
        </div>
    </nav>
    <div class="container pb-4">
        <div class="row mt-4">
            <div class="col-md-4 offset-4">
                <div class="card">
                    <div class="card-body p-0 p-md-4">
                        <h3 class="text-center">Silahkan Login</h3>
                        <hr>
                        <form action="#" method="POST" onsubmit="event.preventDefault();doSubmit(this);">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required placeholder="masukkan isian">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required placeholder="masukkan isian">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function doSubmit(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('login.store') }}",
                data: new FormData(dt),
                dataType: "JSON",
                contentType: false,
                processData: false,
                beforeSend: function(res) {
                    Swal.fire({
                        title: 'Loading ...',
                        html: '<i style="font-size:25px;" class="fa fa-spinner fa-spin"></i>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                error: function(res) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal',
                        text: res.responseJSON.msg ?? res.responseJSON.message,
                        showConfirmButton: true,
                    })
                },
                success: function(res) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Akun ditemukan',
                            showConfirmButton: true,
                        })
                        .then(() => {
                            location.href = res.link;
                        })
                }
            });
        }
    </script>
</body>

</html>
