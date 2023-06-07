<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Keluhan;
use App\Models\Penghuni;
use App\Models\Tagihan;
use App\Models\Pengeluaran;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::latest()->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = '<button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-outline-primary btn-icon show"><i class="feather icon-eye"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    // $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_active == 1) {
                        return '<span class="badge badge-success">Aktif</span>';
                    } else {
                        return '<span class="badge badge-danger">Tidak</span>';
                    }

                    return $row->user->nama;
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view('pemilik.user.index');
    }

    public function store(Request $request)
    {
        return response()->json(['error' => 'Something went wrong'], 422);
    }

    public function edit($id)
    {
        $query = User::find($id);
        return view('pemilik.user.edit', compact('query'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'nama' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jk' => 'required|string',
            'no_hp' => 'required|string',
            'role' => 'required|in:Penghuni,Pemilik,Admin',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_active' => 'required|integer',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->nama = $request->nama;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->alamat = $request->alamat;
        $user->jk = $request->jk;
        $user->no_hp = $request->no_hp;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->is_active = $request->is_active;

        if ($request->password != Null) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->withSuccess(['success' => 'User berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        return response()->json(['error' => 'Hanya dapat menghapus user dari menu Penghuni.'], 422);
    }

    public function profile(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        return view('profile', compact('user'));
    }

    public function profil_update(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validatedData) {
            $user = User::find(\Auth::user()->id);

            $user->nama = $request->nama;
            $user->tgl_lahir = $request->tgl_lahir;
            $user->alamat = $request->alamat;
            $user->jk = $request->jk;
            $user->no_hp = $request->no_hp;
            $user->email = $request->email;

            if ($request->password != Null) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
        }
    }

    public function pemilik_dashboard()
    {
        $kamar = Kamar::all();
        $pengeluaran = Pengeluaran::all();
        $pengeluaranList = Pengeluaran::orderBy('tgl_pengeluaran', 'desc')->paginate(5);
        $user = User::all();
        $keluhan = Keluhan::all();
        $penghuni = Penghuni::all();
        $tagihan = Tagihan::all();
        $tagihanList = Tagihan::orderBy('tgl_tagihan', 'desc')->paginate(5);
        return view('dashboard_pemilik', compact('kamar','pengeluaran','user','keluhan','penghuni','tagihan','tagihanList','pengeluaranList'));
    }

}
