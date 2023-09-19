@extends('front_template')

@section('title', $title)

@section('header', $header)

@section('konten')
    <div class="row">
        <div class="col-md-6 mt-md-0">
            <div class="card bg-primary">
                <div class="card-body text-white">
                    <h4 class="text-center">Total User</h4>
                    <h3 class="text-center">{{ rupiah($total_user) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2 mt-md-0">
            <div class="card bg-danger">
                <div class="card-body text-white">
                    <h4 class="text-center">Total Produk</h4>
                    <h3 class="text-center">{{ rupiah($total_produk) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2 mt-md-4">
            <div class="card bg-success">
                <div class="card-body text-white">
                    <h4 class="text-center">Total Quantity</h4>
                    <h3 class="text-center">{{ rupiah($total_qty) }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
