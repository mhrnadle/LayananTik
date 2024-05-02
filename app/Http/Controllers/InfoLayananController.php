<?php

namespace App\Http\Controllers;

use App\DataTables\InfoLayananDataTable;
use App\Models\InfoLayanan;
use Illuminate\Http\Request;

class InfoLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:infolayanan-list|infolayanan-create|infolayanan-edit|infolayanan-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:infolayanan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:infolayanan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:infolayanan-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(InfoLayananDataTable $dataTable)
    {
        return $dataTable->render('info_layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('info_layanan.create');
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

        InfoLayanan::create($request->all());
        return redirect()->route('info-layanan.index')->with('success', 'Data layanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $infoLayanan = InfoLayanan::find($id);
        $infoLayanan->layanan_status = $infoLayanan->layanan_status == 1 ? 0 : 1;
        $infoLayanan->save();
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
