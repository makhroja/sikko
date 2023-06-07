<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penghuni;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class PenghuniController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Penghuni::latest()->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->user->nama . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('nama', function ($row) {
                    return $row->user->nama;
                })
                ->addColumn('nama_kost', function ($row) {
                    return $row->kamar->no_kamar . " | " . $row->kamar->nama_kost;
                })
                ->addColumn('tipe', function ($row) {
                    return $row->tipe;
                })
                ->addColumn('jk', function ($row) {
                    return $row->user->jk;
                })
                ->addColumn('no_hp', function ($row) {
                    return $row->user->no_hp;
                })
                ->addColumn('alamat', function ($row) {
                    return $row->user->alamat;
                })
                ->rawColumns(['actions', 'nama', 'nama_kost', 'jk', 'no_hp', 'alamat'])
                ->make(true);
        }

        $kamar = Kamar::orderBy('no_kamar', 'asc')->get();
        $user = User::orderBy('nama', 'asc')->get();
        return view('pemilik.penghuni.index', compact('kamar', 'user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'kamar_id' => 'required',
            'tgl_masuk' => 'required',
            'tipe' => 'required',
            'status' => 'required',
            'email' => 'required',
        ]);

        if ($validatedData) {
            $password = explode("-", $request->tgl_lahir);
            $user = User::create([
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'role' => 'Penghuni',
                'email' => $request->email,
                'email_verified_at' => now(),
                'is_active' => 1,
                'password' => implode("", $password),
            ]);
dd(implode("", $password));
            $penghuni = Penghuni::create([
                'user_id' => $user->id,
                'kamar_id' => $request->kamar_id,
                'tgl_masuk' => $request->tgl_masuk,
                'tipe' => $request->tipe,
                'status' => $request->status
            ]);
        }

        return redirect()->route('penghuni.index')->withSuccess(['success' => 'Kamar berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Penghuni::with('user')->where('id', $id)->first();
        $kamar = Kamar::orderBy('no_kamar', 'asc')->get();
        $user = User::orderBy('nama', 'asc')->get();
        return view('pemilik.penghuni.edit', compact('query', 'kamar', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'kamar_id' => 'required',
            'tgl_masuk' => 'required',
            'tipe' => 'required',
            'status' => 'required',
        ]);

        if ($validatedData) {
            $penghuni = Penghuni::find($id)->update([
                'user_id' => $request->user_id,
                'kamar_id' => $request->kamar_id,
                'tgl_masuk' => $request->tgl_masuk,
                'tipe' => $request->tipe,
                'tgl_keluar' => $request->tgl_keluar,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('penghuni.index')->withSuccess(['success' => 'Penghuni berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $penghuni = Penghuni::find($id);
        User::find($penghuni->user_id)->delete();
        $penghuni->delete();

        return response()->json(['success' => 'Kamar berhasil dihapus.']);
    }
}
