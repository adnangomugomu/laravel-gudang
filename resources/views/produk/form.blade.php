<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="form-group">
        <label>User Pemilik</label>
        <select name="user_id" class="form-control form_select" data-placeholder="pilih user" required>
            <option value=""></option>
            @foreach ($all_user as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control" placeholder="masukkan isian" required></textarea>
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="qty" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" name="tgl_masuk" class="form-control" placeholder="masukkan isian" required>
    </div>
    <button type="submit" class="btn btn-primary">SUBMIT</button>
</form>

<script>
    $(document).ready(function() {
        $('.form_select').select2({
            width: '100%',
        })
    });

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
                    url: "{{ route('produk.store') }}",
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
