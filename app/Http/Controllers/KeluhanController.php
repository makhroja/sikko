<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Penghuni;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class KeluhanController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Keluhan::latest()->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('nama', function($row){
                    return $row->user->nama;
                })
                ->addColumn('solusi', function($row){
                    if (is_null($row->solusi)) {
                        return '';
                    } else {
                       return $row->solusi;
                    }

                })
                ->addColumn('kamar', function($row){
                    $penghuni = Penghuni::find($row->user->id);
                    return $penghuni->kamar->no_kamar . " | " . $penghuni->kamar->nama_kost;
                })
                ->rawColumns(['actions','nama','kamar','solusi'])
                ->make(true);
        }

        $user = User::latest()->get();
        return view('pemilik.keluhan.index', compact('user'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'keluhan' => 'required',
            'tgl_keluhan' => 'required|date',
            'status' => 'required|integer',
        ]);

        if ($validatedData) {
            Keluhan::create($request->all());
        }

        return redirect()->route('keluhan.index')->withSuccess(['success' => 'Keluhan berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Keluhan::find($id);
        $user = User::latest()->get();
        return view('pemilik.keluhan.edit', compact('query','user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'user_id' => 'required',
            'keluhan' => 'required',
            'tgl_keluhan' => 'required|date',
            'status' => 'required|integer',
        ]);

        if ($validatedData) {
            Keluhan::find($id)->update($request->all());
        }

        return redirect()->route('keluhan.index')->withSuccess(['success' => 'Keluhan berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        Keluhan::find($id)->delete();
        return response()->json(['success' => 'Keluhan berhasil dihapus.']);
    }
}
