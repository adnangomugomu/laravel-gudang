<form action="#" onsubmit="event.preventDefault();doSubmit(this);">   
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Ulangi Password</label>
        <input type="password" name="re_password" class="form-control" placeholder="masukkan isian" required>
    </div>
    <button type="submit" class="btn btn-primary">SUBMIT</button>
</form>

<script>
    function doSubmit(dt) {

        Swal.fire({
            title: 'Reset Password ?',
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
                    url: "{{ route('registrasi.updatePassword',$id) }}",
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