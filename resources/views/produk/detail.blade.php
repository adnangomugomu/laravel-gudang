<div class="alert alert-primary">
    <h3 class="mb-0 text-center">Pemilik : {{ $row->user->name }}</h3>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <h4>Nama Produk</h4>
            <div>{{ $row->nama }}</div>
        </div>
        <div class="mb-2">
            <h4>Deskripsi</h4>
            <div>{{ $row->deskripsi }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <h4>Quantity</h4>
            <div>{{ $row->qty }}</div>
        </div>
        <div class="mb-2">
            <h4>Tanggal Masuk</h4>
            <div>{{ date('d-M-Y',strtotime($row->tgl_masuk)) }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-sm btn-danger w-25">Hapus Data</button>
    </div>
</div>