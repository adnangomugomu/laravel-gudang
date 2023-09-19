<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegistrasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Registrasi',
            'header' => 'Akun yang sudah terdaftar',
        ];
        return view('register.index', $data);
    }

    public function create()
    {
        $data = [];
        $html = view('register.form', $data)->render();

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
                'name' => 'required|min:5',
                'email' => 'required|min:5|email:rfc,dns|unique:users,email',
                'username' => 'required|min:5|unique:users,username',
                'password' => 'required|min:5|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!?])/',
                're_password' => 'required|min:5|same:password',
            ], [
                'regex' => ':attribute wajib menggunakan huruf kapital, angka dan karakter'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = new User();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->username = $request->username;
                $data->password = Hash::make($request->password);
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
        $row = User::find($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('register.detail', $data)->render();

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
        $row = User::find($id);
        if ($row) {
            $data['row'] = $row;
            $html = view('register.formEdit', $data)->render();

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
                'name' => 'required|min:5',
                'email' => ['required', 'min:5', 'email:rfc,dns', Rule::unique('users')->ignore($id)],
                'username' => ['required', 'min:5', Rule::unique('users')->ignore($id)],
                'foto' => 'image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = User::where('id', $id)->first();
                $data->name = $request->name;
                $data->email = $request->email;
                $data->username = $request->username;

                if ($request->hasFile('foto')) {
                    $photo = $request->file('foto');
                    $filename = time() . '-' . mt_rand(1, 100000) . '.' . $photo->getClientOriginalExtension();
                    $cek = $photo->storeAs('public/foto', $filename);
                    $data->foto = 'storage/foto/'.$filename;
                }

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
        $data = User::find($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => 'Data tidak ditemukan'
            ], 400);
        }
    }

    public function getDataTable(Request $request)
    {
        $data = User::with('produk')->orderBy('created_at', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('totalProduk', function ($user) {
                $totalQty = collect($user->produk)->sum('qty');
                return '
                    <span>Produk ' . count($user->produk) . '</span>
                    <div class="text-danger">QTY ' . rupiah($totalQty) . '<div>
                ';
            })
            ->addColumn('action', function ($user) {
                return '
                    <button type="button" onclick="editData(\'' . $user->id . '\');" class="btn btn-sm btn-warning">Edit</button>                    
                    <button type="button" onclick="detailData(\'' . $user->id . '\');" class="btn btn-sm btn-success">Detail</button>
                    <br>
                    <button type="button" onclick="resetPassword(\'' . $user->id . '\');" class="btn btn-sm btn-info mt-1">Reset Password</button>
                ';
            })
            ->escapeColumns('active')
            ->make(true);
    }

    public function resetPassword($id)
    {
        $data['id'] = $id;
        $html = view('register.resetPassword', $data)->render();
        return response()->json([
            'html' => $html,
        ], 200);
    }

    public function updatePassword(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:5|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!?])/',
                're_password' => 'required|min:5|same:password',
            ], [
                'regex' => ':attribute wajib menggunakan huruf kapital, angka dan karakter'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'msg' => $validator->getMessageBag()->all(),
                ], 400);
            } else {
                $data = User::where('id', $id)->first();
                $data->password = Hash::make($request->password);
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
}
