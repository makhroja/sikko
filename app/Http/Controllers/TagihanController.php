<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Penghuni;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class TagihanController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Tagihan::orderBy('tgl_tagihan', 'desc')->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('nama',function($row){
                    return $row->user->nama;
                })
                ->addColumn('status',function($row){
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Lunas</span>';
                    } else {
                        return '<span class="badge badge-danger">Belum</span>';
                    }

                    return $row->user->nama;
                })
                ->rawColumns(['actions','nama', 'status'])
                ->make(true);
        }

        $user = User::latest()->get();
        return view('pemilik.tagihan.index', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'no_tagihan' => 'required',
            'tgl_tagihan' => 'required|date',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'total_tagihan' => 'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validatedData) {
            Tagihan::create($request->all());
        }

        return redirect()->route('tagihan.index')->withSuccess(['success' => 'Tagihan berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Tagihan::find($id);
        $user = User::latest()->get();
        return view('pemilik.tagihan.edit', compact('query', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'user_id' => 'required|integer',
            'tgl_tagihan' => 'required|date',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'total_tagihan' => 'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validatedData) {
            Tagihan::find($id)->update($request->all());
        }

        return redirect()->route('tagihan.index')->withSuccess(['success' => 'Tagihan berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        Tagihan::find($id)->delete();
        return response()->json(['success' => 'Tagihan berhasil dihapus.']);
    }
}
