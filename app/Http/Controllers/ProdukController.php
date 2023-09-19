<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Produk',
            'header' => 'Daftar Produk',
            'konten' => 'konten',
        ];
        return view('produk.index', $data);
    }

    public function create()
    {
        $data['all_user'] = User::orderBy('name', 'asc')->get();
        $html = view('produk.form', $data)->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'nama' => 'required|min:5',
                'deskripsi' => 'required|min:10',
                'qty' => 'required|numeric|min:5',
                'tgl_masuk' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new Produk();
                $data->user_id = $request->user_id;
                $data->nama = $request->nama;
                $data->deskripsi = $request->deskripsi;
                $data->qty = $request->qty;
                $data->tgl_masuk = $request->tgl_masuk;
                $data->save();
                DB::commit();

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());

            return response()->json([
                'status' => 'failed',
                'msg' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function show($id)
    {
        $row = Produk::find($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('produk.detail', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function edit($id)
    {
        $row = Produk::find($id);
        if ($row) {
            $data['row'] = $row;
            $data['all_user'] = User::orderBy('name','asc')->get();
            $html = view('produk.formEdit', $data)->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Data tidak ditemukan',
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'nama' => 'required|min:5',
                'deskripsi' => 'required|min:10',
                'qty' => 'required|numeric|min:5',
                'tgl_masuk' => 'required|date',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = Produk::where('id', $id)->first();
                $data->user_id = $request->user_id;
                $data->nama = $request->nama;
                $data->deskripsi = $request->deskripsi;
                $data->qty = $request->qty;
                $data->tgl_masuk = $request->tgl_masuk;
                $data->save();
                DB::commit();
                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e->getMessage());

            return response()->json([
                'status' => 'failed',
                'msg' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    public function destroy($id)
    {
        $data = Produk::find($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'success',
            ], 200);
        } else {
            return response()->json([
                'msg' => 'data tidak ditemukan',
            ], 400);
        }
    }

    public function getDataTable(Request $request)
    {
        $data = Produk::with('user')->orderBy('created_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('userPemilik', function ($produk) {
                return $produk->user->name;
            })
            ->editColumn('tgl_masuk', function ($produk) {
                return date('d-M-Y', strtotime($produk->tgl_masuk));
            })
            ->editColumn('deskripsi', function ($produk) {
                return Str::limit($produk->deskripsi, 50, '...');
            })
            ->addColumn('action', function ($produk) {
                return '
                    <button type="button" onclick="editData(\'' . $produk->id . '\');" class="btn btn-sm btn-warning">Edit</button>                    
                    <button type="button" onclick="detailData(\'' . $produk->id . '\');" class="btn btn-sm btn-success">Detail</button>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }
}
