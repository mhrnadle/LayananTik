<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriLayananDataTable;
use App\DataTables\KategoriSubLayananDataTable;
use App\Models\KategoriLayanan;
use App\Models\User;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:layanan-list|layanan-create|layanan-edit|layanan-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:layanan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:layanan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:layanan-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(KategoriLayananDataTable $dataTableLayanan,KategoriSubLayananDataTable $dataTableSubLayanan)
    {
        return view('layanan.index', [
            'dataTable' => $dataTableLayanan->html(),
            'dataTableSubLayanan' => $dataTableSubLayanan->html()
        ]);
    }

    public function layanan(KategoriLayananDataTable $dataTable)
    {
        return $dataTable->render('layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kunker' => 'required',
            'kl_label' => 'required',
            'kl_status' => 'required',
        ]);
        
        $input = [
            'kunker' => $request->kunker,
            'kl_label' => $request->kl_label,
            'kl_status' => $request->kl_status,
            'updated_by' => auth()->user()->id
        ];

        KategoriLayanan::create($input);

        return redirect()->route('layanan.index')->with('success', "Layanan ".$input['kl_label']." created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $layanan = KategoriLayanan::find($id);
        if(!$layanan) {
            return redirect()->route('layanan.index')->with('error', 'Layanan not found.');
        }
        $layanan->kl_status = $layanan->kl_status == 1 ? 0 : 1;
        $layanan->save();
        return redirect()->back()->with('success', 'Layanan '.$layanan->kl_label.' status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, KategoriSubLayananDataTable $dataTableSubLayanan)
    {
        $layanan = KategoriLayanan::find($id);
        $sublayanan = $dataTableSubLayanan->html()->ajax(route('layanan.sublayanan', $id))->parameters(['processing' => true]);
        return view('layanan.edit', compact('layanan', 'sublayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'kl_label' => 'required',
            'kl_status' => 'required',
        ]);

        $layanan = KategoriLayanan::find($id);
        if (!$layanan) {
            return redirect()->route('layanan.index')->with('error', 'Layanan not found.');
        }

        $input = [
            'kl_label' => $request->kl_label,
            'kl_status' => $request->kl_status,
            'kunker' => $request->kunker,
            'updated_by' => auth()->user()->id
        ];

        $layanan->update($input);
        return redirect()->route('layanan.index')->with('success', 'Layanan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanan = KategoriLayanan::find($id);
        $layanan->delete();

        return redirect()->route('layanan.index')
            ->with('success', 'Layanan deleted successfully');
    }
}
