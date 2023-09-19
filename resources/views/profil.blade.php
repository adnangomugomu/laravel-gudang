@extends('front_template')

@section('title', $title)

@section('header', $header)

@section('konten')
    <div class="text-center mb-2">
        <img src="{{ asset($row->foto) }}" alt="foto" class="img rounded" style="width: 300px;">
    </div>

    <section>
        <h3>Data Diri</h3>
        <table class="table table-bordered">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $row->name }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $row->username }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $row->email }}</td>
            </tr>
            <tr>
                <th>Terdaftar Pada</th>
                <td>{{ tgl_indo($row->created_at) }}</td>
            </tr>
            <tr>
                <th>ID User</th>
                <td>{{ $row->id }}</td>
            </tr>
        </table>
    </section>

    <section class="p-4 rounded" style="background-color: #eaeaea;">
        <h3>Ubah Password</h3>
        <form action="#" method="POST" onsubmit="event.preventDefault();doSubmit(this);">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required placeholder="masukkan isian">
            </div>
            <div class="form-group">
                <label>Ulang Password</label>
                <input type="password" class="form-control" name="re_password" required placeholder="masukkan isian">
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary w-25">Submit</button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script>
        function doSubmit(dt) {

            Swal.fire({
                title: 'Simpan Data ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        url: "{{ route('registrasi.updatePassword',$row->id) }}",
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
                                text: res.responseJSON.msg,
                                showConfirmButton: true,
                            })
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.reload();
                                })
                        }
                    });
                }
            })
        }
    </script>
@endsection
