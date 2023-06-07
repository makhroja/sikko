<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\Kamar;
use App\Models\Keluhan;
use App\Models\Pengeluaran;
use App\Models\Penghuni;
use App\Models\Tagihan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class PenghuniKosController extends Controller
{

    public function penghuni_dashboard()
    {
        $kamar = Kamar::all();
        $user = User::all();
        $keluhan = Keluhan::all();
        $penghuni = Penghuni::all();
        $tagihan = Tagihan::where('user_id', \Auth::user()->id);
        $tagihanList = Tagihan::where('user_id', \Auth::user()->id)->orderBy('tgl_tagihan', 'desc')->paginate(5);
        return view('dashboard_penghuni', compact('kamar','user','keluhan','penghuni','tagihan','tagihanList'));
    }

    public function tagihan(Request $request)
    {

        if ($request->ajax()) {
            $query = Tagihan::where('user_id', \Auth::user()->id)
                ->orderBy('tgl_tagihan', 'desc')->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {

                    $faktur = Faktur::where('tagihan_id', $row->id)->first();

                    if ($faktur && $faktur->status == 1) {
                        $btn = '<button class="btn btn-outline-success">Diterima</button>';
                    } else if ($faktur && $faktur->status == 2 or $row->status == 0) {
                        $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '"   data-total_tagihan="' . $row->total_tagihan . '" data-original-title="Bayar Tagihan" class="btn btn-outline-primary bayar-tagihan">Upload Bukti</button>';
                    } else {
                        $btn = ' <button class="btn btn-outline-secondary">Proses</button>';
                    }

                    return $btn;
                })
                ->addColumn('nama', function ($row) {
                    return $row->user->nama;
                })
                ->addColumn('status', function ($row) {

                    $faktur = Faktur::where('tagihan_id', $row->id)->first();

                    if ($faktur && $faktur->status == 1) {
                        return '<span class="badge badge-success">Lunas</span>';
                    } else if ($row->status == 0) {
                        return '<span class="badge badge-danger">Belum</span>';
                    } else if ($faktur && $faktur->status == 2) {
                        return '<span class="badge badge-danger">Ditolak</span>';
                    } else {
                        return '<span class="badge badge-secondary">Pending</span>';
                    }
                })
                ->rawColumns(['actions', 'nama', 'status'])
                ->make(true);
        }

        return view('penghuni.tagihan.index');
    }

    public function bayarTagihan(Request $request)
    {
        $validatedData = $request->validate([
            'tagihan_id' => 'required',
            'no_faktur' => 'required',
            'total_bayar' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validatedData) {

            $tagihanId = $request->tagihan_id;

            $fakturData = [
                'user_id' => \Auth::user()->id,
                'tagihan_id' => $tagihanId,
                'no_faktur' => generateNoFaktur(),
                'total_bayar' => $request->total_bayar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tgl_bayar' => Carbon::now(),
                'status' => 0,
            ];

            if ($request->hasFile('bukti_pembayaran')) {
                $oldFaktur = Faktur::where('tagihan_id', $tagihanId)->first();

                if ($oldFaktur && $oldFaktur->bukti_pembayaran) {
                    \File::delete(public_path('/images/bukti_pembayaran') . '/' . $oldFaktur->bukti_pembayaran);
                }

                $filename = time() . rand(1, 100) . '.' . $request->bukti_pembayaran->extension();
                if ($request->bukti_pembayaran->move(public_path('/images/bukti_pembayaran'), $filename)) {
                    $fakturData['bukti_pembayaran'] = $filename;
                }
            }

            Faktur::updateOrCreate(['tagihan_id' => $tagihanId], $fakturData);

            Tagihan::find($tagihanId)->update(['status' => 2]);
        }

        return redirect()->route('penghuni.tagihan')->withSuccess(['success' => 'Bukti pembayaran berhasil diupload.']);
    }

    public function keluhan(Request $request)
    {
        if ($request->ajax()) {
            $query = Keluhan::where('user_id', \Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = ' <button href="javascript:void(0)" data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-outline-success btn-icon edit"><i class="feather icon-edit"></i></button>';

                    $btn = $btn . ' <button href="javascript:void(0)" data-name="' . $row->name . '" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-danger btn-icon delete"><i class="feather icon-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('nama', function ($row) {
                    return $row->user->nama;
                })
                ->addColumn('solusi', function ($row) {
                    if (is_null($row->solusi)) {
                        return 'Belum ditanggapi';
                    } else {
                        return $row->solusi;
                    }
                })
                ->addColumn('kamar', function ($row) {
                    $penghuni = Penghuni::where('user_id', \Auth::user()->id)->first();
                    return $penghuni->kamar->no_kamar . " | " . $penghuni->kamar->nama_kost;
                })
                ->rawColumns(['actions', 'nama', 'kamar'])
                ->make(true);
        }

        return view('penghuni.keluhan.index');
    }

    public function keluhan_store(Request $request)
    {
        $validatedData = $request->validate([
            'keluhan' => 'required',
        ]);

        if ($validatedData) {

            $data = array_merge($request->all(), [
                'user_id' => \Auth::user()->id,
                'tgl_keluhan' => Carbon::now(),
                'status' => 0
            ]);

            Keluhan::create($data);
        }

        return redirect()->route('penghuni.keluhan')->withSuccess(['success' => 'Keluhan berhasil ditambahkan.']);
    }

    public function keluhan_edit($id)
    {
        $query = Keluhan::find($id);

        if ($query->solusi != null) {
            return redirect()->back()->with(['error' => 'Keluhan sudah ditanggapi tidak bisa dihapus atau diedit.']);
        }
        return view('penghuni.keluhan.edit', compact('query'));
    }

    public function keluhan_update(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'keluhan' => 'required',
        ]);

        if ($validatedData) {

            $keluhan = Keluhan::findOrFail($id);
            $keluhan->update($request->all());
        }

        return redirect()->route('penghuni.keluhan')->withSuccess(['success' => 'Keluhan berhasil diperbarui.']);
    }

    public function keluhan_destroy($id)
    {
        $keluhan = Keluhan::find($id);
        if (is_null($keluhan->solusi)) {
            $keluhan->delete();
            return response()->json(['success' => 'Keluhan berhasil dihapus.']);
        }
        return response()->json(['success' => 'Keluhan sudah ditanggapi tidak bisa dihapus atau diedit.']);
    }
}
