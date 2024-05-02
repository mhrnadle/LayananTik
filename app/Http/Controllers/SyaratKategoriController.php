<?php

namespace App\Http\Controllers;

use App\DataTables\SyaratKategoriDataTable;
use App\Models\SyaratKategori;
use App\Http\Controllers\Controller;
use App\Models\KategoriSublayanan;
use Illuminate\Http\Request;

class SyaratKategoriController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:syarat-list|syarat-create|syarat-edit|syarat-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:syarat-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:syarat-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:syarat-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SyaratKategoriDataTable $dataTable)
    {
        if($this->authorize('layanan-create')){
            return $dataTable->render('syarat.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sublayanan = KategoriSublayanan::all();
        $type_file = ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png', '.zip', '.rar'];
        return view('syarat.create', compact('sublayanan','type_file'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $saved = null;
        $file_name = null;
        try{
            $request->validate([
                'syarat_label' => 'required',
                'syarat_type' => 'required|in:Umum,Khusus',
                'syarat_type_file' => 'required',
            ]);
            if($request->syarat_type == 'Khusus'){
                $request->validate([
                    'syarat_kategori_id' => 'required',
                ]);
            }
            $request->merge([
                'syarat_type_file' => implode(';', $request->syarat_type_file)
            ]);
            
            if($request->hasFile('syarat_template')){
                $file_name = uniqid().'_'.trim($request->syarat_template->getClientOriginalName());
                $request->syarat_template->move(public_path('templates'), $file_name);
            }
            $saved = SyaratKategori::create([
                'syarat_label' => $request->syarat_label,
                'syarat_type' => $request->syarat_type,
                'syarat_type_file' => $request->syarat_type_file,
                'syarat_template' => $file_name,
                'syarat_kategori_id' => $request->syarat_kategori_id,
            ]);
    
            return redirect()->route('syarat.index')->with('success', 'Syarat Kategori created successfully.');
        } catch (\Exception $e) {
            if($saved){
                $saved->delete();
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $syarat = SyaratKategori::find($id);
        if(!$syarat) {
            return redirect()->route('syarat.index')->with('error', 'Syarat Kategori not found.');
        }
        $syarat->syarat_status = $syarat->syarat_status == 1 ? 0 : 1;
        $syarat->update();
        return redirect()->route('syarat.index')->with('success', 'Syarat Kategori '.$syarat->syarat_label.' status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $syarat = SyaratKategori::find($id);
        $sublayanan = KategoriSublayanan::all();
        $type_file = ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png', '.zip', '.rar'];
        return view('syarat.edit', compact('syarat', 'sublayanan', 'type_file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file_name = null;
        try{
            $this->validate($request, [
                'syarat_label' => 'required',
                'syarat_type' => 'required|in:Umum,Khusus',
                'syarat_type_file' => 'nullable',
                'syarat_status' => 'required|in:0,1',
                'syarat_template' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip,rar'
            ]);
    
            $syarat = SyaratKategori::find($id);
            if(!$syarat) {
                return redirect()->route('syarat.index')->with('error', 'Syarat Kategori not found.');
            }
            
            if($request->syarat_type == 'Khusus'){
                $request->validate([
                    'syarat_kategori_id' => 'required',
                ]);
            }

            if($request->hasFile('syarat_template')){
                $file_name = uniqid().'_'.trim($request->syarat_template->getClientOriginalName());
                $request->syarat_template->move(public_path('templates'), $file_name);
            }

            $request->merge([
                'syarat_type_file' => implode(';', $request->syarat_type_file)
            ]);

            $syarat->update([
                'syarat_label' => $request->syarat_label,
                'syarat_type' => $request->syarat_type,
                'syarat_type_file' => $request->syarat_type_file,
                'syarat_template' => $file_name,
                'syarat_kategori_id' => $request->syarat_kategori_id,
                'syarat_status' => $request->syarat_status,
            
            ]);

            return redirect()->route('syarat.edit', $id)->with('success', 'Syarat Kategori updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $syarat = SyaratKategori::find($id);
        if(!$syarat) {
            return redirect()->route('syarat.index')->with('error', 'Syarat Kategori not found.');
        }
        $syarat->delete();
        return redirect()->route('syarat.index')->with('success', 'Syarat Kategori deleted successfully.');
    }
}
