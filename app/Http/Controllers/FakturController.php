<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\Pengeluaran;
use App\Models\Tagihan;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class FakturController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Faktur::latest()->get();

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
                ->addColumn('bukti', function ($row) {

                    $button = '<button class="btn btn-primary btn-sm show-bukti" data-bukti-image="' . url("images/bukti_pembayaran/") . "/" . $row->bukti_pembayaran . '">Lihat Bukti</button>';

                    return $button;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Lunas</span>';
                    } else {
                        return '<span class="badge badge-danger">Belum</span>';
                    }

                    return $row->user->nama;
                })
                ->rawColumns(['actions', 'nama', 'status', 'bukti'])
                ->make(true);
        }

        $tagihan = Tagihan::where('status', 0)->orderBy('created_at', 'desc')->get();
        $user = User::latest()->get();
        return view('pemilik.faktur.index', compact('user', 'tagihan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tagihan_id' => 'required',
            'no_faktur' => 'required',
            'total_bayar' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'tgl_bayar' => 'required|date',
            'status' => 'required|integer',
        ]);

        $tagihan = Tagihan::find($request->tagihan_id);

        if ($validatedData) {

            $faktur = new Faktur();
            $faktur->user_id = $tagihan->user_id;
            $faktur->tagihan_id = $request->tagihan_id;
            $faktur->no_faktur = $request->no_faktur;
            $faktur->total_bayar = $request->total_bayar;
            $faktur->metode_pembayaran = $request->metode_pembayaran;
            $faktur->tgl_bayar = $request->tgl_bayar;
            $faktur->status = $request->status;

            if ($request->hasFile('bukti_pembayaran')) {

                $filename = time() . rand(1, 100) . '.' . $request->bukti_pembayaran->extension();
                if ($request->bukti_pembayaran->move(public_path('/images/bukti_pembayaran'), $filename)) {
                    $faktur->bukti_pembayaran = $filename;
                }
            }

            $faktur->save();
        }

        return redirect()->route('faktur.index')->withSuccess(['success' => 'Faktur berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $query = Faktur::find($id);
        $user = User::latest()->get();
        $tagihan = Tagihan::orderBy('created_at', 'desc')->get();
        return view('pemilik.faktur.edit', compact('query', 'user', 'tagihan'));
    }

    public function update(Request $request, $id)
    {

        $validatedData =  $request->validate([
            'tagihan_id' => 'required',
            'no_faktur' => 'required',
            'total_bayar' => 'required',
            'metode_pembayaran' => 'required',
            'tgl_bayar' => 'required|date',
            'status' => 'required|integer',
        ]);

        $tagihan = Tagihan::find($request->tagihan_id);

        if ($validatedData) {
            $faktur = Faktur::find($id);
            $faktur->user_id = $tagihan->user_id;
            $faktur->tagihan_id = $request->tagihan_id;
            $faktur->no_faktur = $request->no_faktur;
            $faktur->total_bayar = $request->total_bayar;
            $faktur->metode_pembayaran = $request->metode_pembayaran;
            $faktur->tgl_bayar = $request->tgl_bayar;
            $faktur->status = $request->status;

            if ($request->hasFile('bukti_pembayaran')) {

                $request->validate(['bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif|max:5120',]);

                $filename = time() . rand(1, 100) . '.' . $request->bukti_pembayaran->extension();
                if ($request->bukti_pembayaran->move(public_path('/images/bukti_pembayaran'), $filename)) {
                    $destination = 'images/bukti_pembayaran/' . $faktur->bukti_pembayaran;

                    if (\File::exists($destination)) {
                        \File::delete($destination);
                    }

                    $faktur->delete();

                    $faktur->bukti_pembayaran = $filename;
                }
            }

            $faktur->save();
        }

        return redirect()->route('faktur.index')->withSuccess(['success' => 'Faktur berhasil diperbarui.']);
    }

    public function destroy($id)
    {

        if ($faktur = Faktur::find($id)) {

            $faktur = Faktur::find($id);
            $destination = 'images/bukti_pembayaran/' . $faktur->bukti_pembayaran;

            if (\File::exists($destination)) {
                \File::delete($destination);
            }

            $faktur->delete();

            return response()->json(['success' => 'Faktur berhasil dihapus.']);
        }

        return response()->json(['error' => $faktur], 422);
    }

    public function keuangan(Request $request)
    {

        if ($request->has('tahun')) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;

            $pemasukan = Faktur::whereMonth('tgl_bayar', $bulan)
                ->whereYear('tgl_bayar', $tahun)
                ->orderBy('tgl_bayar', 'Desc')->paginate(10);

            $pengeluaran = Pengeluaran::whereMonth('tgl_pengeluaran', $bulan)
                ->whereYear('tgl_pengeluaran', $tahun)
                ->orderBy('tgl_pengeluaran', 'Desc')->paginate(10);

        } else {
            $pemasukan = Faktur::orderBy('tgl_bayar', 'Desc')->paginate(10);
            $pengeluaran = Pengeluaran::orderBy('tgl_pengeluaran', 'Desc')->paginate(10);
        }
        $totalPemasukan = $pemasukan->sum('total_bayar');
        $totalPengeluaran = $pengeluaran->sum('total');
        return view('pemilik.keuangan.index', compact('pemasukan', 'pengeluaran','totalPemasukan', 'totalPengeluaran'));
    }
}
