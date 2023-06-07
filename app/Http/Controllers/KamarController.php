<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use DataTables;

class KamarController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Kamar::latest()->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('pemilik.kamar.index');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_kamar' => 'required|numeric',
            'lokasi' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required',
            'status' => 'required|in:0,1',
        ]);

        if ($validatedData) {
            Kamar::create($request->all());
        }

        return redirect()->route('kamar.index')->withSuccess(['success' => 'Kamar berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Kamar::find($id);
        return view('pemilik.kamar.edit', compact('query'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_kamar' => 'required|numeric',
            'lokasi' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required',
            'status' => 'required|in:0,1',
        ]);

        if ($validatedData) {
            Kamar::find($id)->update($request->all());
        }

        return redirect()->route('kamar.index')->withSuccess(['success' => 'Kamar berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        Kamar::find($id)->delete();
        return response()->json(['success' => 'Kamar berhasil dihapus.']);
    }
}
