<form action="#" onsubmit="event.preventDefault();doSubmit(this);" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" value="{{ $row->name }}" name="name" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" value="{{ $row->email }}" name="email" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" value="{{ $row->username }}" name="username" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label class="d-block">Foto Profil</label>
        <input type="file" accept="image/*" name="foto" class="btn btn-success btn-rounded w-25" placeholder="masukkan isian">
    </div>
    <button type="submit" class="btn btn-primary">SUBMIT</button>
</form>

<script>
    function doSubmit(dt) {

        Swal.fire({
            title: 'Update Data ?',
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
                    url: "{{ route('registrasi.update', $row->id) }}",
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
                        $('#modal_custom').modal('hide');
                        Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                showConfirmButton: true,
                            })
                            .then(() => {
                                $('#table-data').DataTable().ajax.reload();
                            })
                    }
                });
            }
        })
    }
</script>
