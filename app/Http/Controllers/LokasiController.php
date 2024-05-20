<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LokasiDataTable;
use App\Models\LokasiAset;

class LokasiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware(['permission:aset-list|aset-create|aset-edit|aset-delete'], ['only' => ['index', 'show']]);
    //     $this->middleware(['permission:aset-create'], ['only' => ['create', 'store']]);
    //     $this->middleware(['permission:aset-edit'], ['only' => ['edit', 'update']]);
    //     $this->middleware(['permission:aset-delete'], ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(LokasiDataTable $dataTable)
    {
        return $dataTable->render('lokasiaset.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aset.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaAset' => 'required',
            'JenisAset' => 'required',
            'Deskripsi' => 'required',
            'IDLokasi' => 'required|unique:aset,idlokasi',
            'IDKategori' => 'required|unique:aset,idkategori',
            'Kondisi' => 'required',
            'TanggalPembelian' => 'required',
            'NilaiAset' => 'required|default:0',
            'Catatan' => 'required',
        ]);

        Aset::create($request->all());
        return redirect()->route('aset.index')->with('success', 'Data aset berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aset = Aset::find($id);
        $aset->layanan_status = $aset->layanan_status == 1 ? 0 : 1;
        $aset->save();
        return redirect()->back()->with('success', 'Status layanan berhasil diubah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aset = Aset::find($id);
        return view('aset.edit', compact('aset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NamaAset' => 'required',
            'JenisAset' => 'required',
            'Deskripsi' => 'required',
            'IDLokasi' => 'required|unique:aset,idlokasi',
            'IDKategori' => 'required|unique:aset,idkategori',
            'Kondisi' => 'required',
            'TanggalPembelian' => 'required',
            'NilaiAset' => 'required|default:0',
            'Catatan' => 'required',
        ]);

        $aset = Aset::find($id);
        $aset->update($request->all());
        return redirect()->route('aset.index')->with('success', 'Data aset berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aset = Aset::find($id);
        $aset->delete();
        return redirect()->back()->with('success', 'Data aset berhasil dihapus');
    }
}
