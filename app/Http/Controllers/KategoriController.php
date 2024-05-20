<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriAset;

class KategoriController extends Controller
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
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategoriaset.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriaset.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_nama' => 'required',
            'layanan_slug' => 'required|unique:info_layanan,layanan_slug',
            'layanan_desc' => 'required',
            'layanan_apk' => 'required',
            'layanan_status' => 'required|default:0',
            'layanan_sop' => 'required',
        ]);

        KategoriAset::create($request->all());
        return redirect()->route('kategoriaset.index')->with('success', 'Data Kategori aset berhasil ditambahkan');
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
        $infoLayanan = InfoLayanan::find($id);
        return view('info_layanan.edit', compact('infoLayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'layanan_nama' => 'required',
            'layanan_desc' => 'required',
            'layanan_apk' => 'required',
            'layanan_status' => 'required|default:0',
            'layanan_sop' => 'required',
        ]);

        $infoLayanan = InfoLayanan::find($id);
        $infoLayanan->update($request->all());
        return redirect()->route('info-layanan.index')->with('success', 'Data layanan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $infoLayanan = InfoLayanan::find($id);
        $infoLayanan->delete();
        return redirect()->back()->with('success', 'Data layanan berhasil dihapus');
    }
}
