<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use DataTables;

class PengeluaranController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pengeluaran::latest()->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })

                ->addColumn('bukti', function ($row) {

                    $button = '<button class="btn btn-primary btn-sm show-bukti" data-bukti-image="' . url("images/bukti_pengeluaran/") . "/" . $row->bukti_pengeluaran . '">Lihat Bukti</button>';

                    return $button;
                })

                ->rawColumns(['actions', 'bukti'])
                ->make(true);
        }


        return view('pemilik.pengeluaran.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_pengeluaran' => 'required',
            'total' => 'required',
            'keperluan' => 'required',
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validatedData) {

            $query = new Pengeluaran();
            $query->total = $request->total;
            $query->keperluan = $request->keperluan;
            $query->tgl_pengeluaran = $request->tgl_pengeluaran;

            if ($request->hasFile('bukti_pengeluaran')) {

                $filename = time() . rand(1, 100) . '.' . $request->bukti_pengeluaran->extension();
                if ($request->bukti_pengeluaran->move(public_path('/images/bukti_pengeluaran'), $filename)) {
                    $query->bukti_pengeluaran = $filename;
                }
            }

            $query->save();
        }

        return redirect()->route('pengeluaran.index')->withSuccess(['success' => 'Pengeluaran berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Pengeluaran::find($id);

        return view('pemilik.pengeluaran.edit', compact('query'));
    }

    public function update(Request $request, $id)
    {

        $validatedData =  $request->validate([
            'tgl_pengeluaran' => 'required',
            'total' => 'required',
            'keperluan' => 'required',
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validatedData) {
            $query = Pengeluaran::find($id);

            $query->total = $request->total;
            $query->keperluan = $request->keperluan;
            $query->tgl_pengeluaran = $request->tgl_pengeluaran;

            if ($request->hasFile('bukti_pengeluaran')) {

                $request->validate(['bukti_pengeluaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',]);

                $filename = time() . rand(1, 100) . '.' . $request->bukti_pengeluaran->extension();
                if ($request->bukti_pengeluaran->move(public_path('/images/bukti_pengeluaran'), $filename)) {
                    $destination = 'images/bukti_pengeluaran/' . $query->bukti_pengeluaran;

                    if (\File::exists($destination)) {
                        \File::delete($destination);
                    }

                    $query->delete();

                    $query->bukti_pengeluaran = $filename;
                }
            }

            $query->save();
        }

        return redirect()->route('pengeluaran.index')->withSuccess(['success' => 'Pengeluaran berhasil diperbarui.']);
    }

    public function destroy($id)
    {

        if ($query = Pengeluaran::find($id)) {

            $query = Pengeluaran::find($id);
            $destination = 'images/bukti_pengeluaran/' . $query->bukti_pengeluaran;

            if (\File::exists($destination)) {
                \File::delete($destination);
            }

            $query->delete();

            return response()->json(['success' => 'Pengeluaran berhasil dihapus.']);
        }

        return response()->json(['error' => $query], 422);
    }

}
