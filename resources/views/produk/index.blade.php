@extends('front_template')

@section('title', $title)

@section('header', $header)

@section('tombol')
    <div>
        <button class="btn btn-primary btn-sm mb-2" onclick="tambahData();"><i class="fa fa-plus mr-1"></i> Tambah Data</button>
    </div>
@endsection

@section('konten')

    <div class="table-responsive">
        <table class="table table-bordered" style="width: 100%" id="table-data">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NO</th>
                    <th>USER PEMILIK</th>
                    <th>NAMA PRODUK</th>
                    <th>DESKRIPSI</th>
                    <th>QTY</th>
                    <th>TANGGAL MASUK</th>
                    <th style="width: 200px;">AKSI</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            load_table();
        });

        function load_table() {
            $('#table-data').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ordering: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: '{{ route('produk.getTable') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        cekId: 123,
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'userPemilik',
                        name: 'userPemilik'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'tgl_masuk',
                        name: 'tgl_masuk'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [],
                columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                }],
            })
        }

        function tambahData() {
            $.ajax({
                type: "GET",
                url: "{{ route('produk.create') }}",
                dataType: "JSON",
                data: {},
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
                    Swal.close();
                    show_modal_custom({
                        judul: 'Tambah Data Produk',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function editData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('produk.edit', '') }}/" + id,
                dataType: "JSON",
                data: {},
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
                    Swal.close();
                    show_modal_custom({
                        judul: 'Edit Data Produk',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('produk.detail', '') }}/" + id,
                dataType: "JSON",
                data: {},
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
                    Swal.close();
                    show_modal_custom({
                        judul: 'Detail Data Produk',
                        html: res.html,
                        size: 'modal-xl',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Data Produk ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('produk.delete', '') }}/" + id,
                        dataType: "JSON",
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
                                    title: 'Berhasil dihapus',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    $('#modal_custom').modal('hide');
                                    $('#table-data').DataTable().ajax.reload();
                                });
                        }
                    });
                }
            })
        }
    </script>
@endsection
