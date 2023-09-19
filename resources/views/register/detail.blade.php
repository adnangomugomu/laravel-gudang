<div class="row">
    <div class="col-md-12">
        <img src="{{ asset($row->foto) }}" alt="foto profil" class="img rounded" style="width: 150px;">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <h4>Nama Lengkap</h4>
            <div>{{ $row->name }}</div>
        </div>
        <div class="mb-2">
            <h4>Username</h4>
            <div>{{ $row->username }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <h4>Email</h4>
            <div>{{ $row->email }}</div>
        </div>
        <div class="mb-2">
            <h4>Terdaftar Pada</h4>
            <div>{{ tgl_indo($row->created_at, 'd-M-Y H:i') }}</div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h4>Produk Yang Dimiliki</h4>
        <table class="table table-bordered">
            <tr>
                <th>NO</th>
                <th>Nama Produk</th>
                <th>QTY</th>
                <th>Deskripsi</th>
            </tr>
            @foreach ($row->produk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ rupiah($item->qty) }}</td>
                    <td>{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-sm btn-danger w-25">Hapus Data</button>
    </div>
</div>