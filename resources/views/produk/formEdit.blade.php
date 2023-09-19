<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="form-group">
        <label>User Pemilik</label>
        <select name="user_id" class="form-control form_select" data-placeholder="pilih user" required>
            <option value=""></option>
            @foreach ($all_user as $item)
                <option {{ $row->user_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" value="{{ $row->nama }}" name="nama" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control" placeholder="masukkan isian" required>{{ $row->deskripsi }}</textarea>
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="number" value="{{ $row->qty }}" name="qty" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input type="date" value="{{ $row->tgl_masuk }}" name="tgl_masuk" class="form-control" placeholder="masukkan isian" required>
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
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    url: "{{ route('produk.update',$row->id) }}",
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
