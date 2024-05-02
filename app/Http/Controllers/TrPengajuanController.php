<?php

namespace App\Http\Controllers;

use App\DataTables\BerkasDataTable;
use App\DataTables\TransaksiDataTable;
use App\Models\TrPengajuan;
use App\Http\Controllers\Controller;
use App\Models\KategoriSublayanan;
use App\Models\SyaratKategori;
use App\Models\TrBerkas;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class TrPengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:pengajuan-list|pengajuan-create|pengajuan-edit|pengajuan-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:pengajuan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:pengajuan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:pengajuan-delete'], ['only' => ['destroy']]);
        $this->middleware(['permission:pengajuan-approve'], ['only' => ['verify']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = auth()->user()->getRoleNames();
        $dataTable = new TransaksiDataTable($role[0]);
        return $dataTable->render('transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_role = auth()->user()->getRoleNames();
        $sublayanan = KategoriSublayanan::where('skl_role', 'like', '%'.$user_role[0].'%')->get();
        $umum = SyaratKategori::where('syarat_type', 'Umum')->get();
        $file_type = '';
        foreach ($umum as $item) {
            $file_type .= str_replace(';', ',', $item->syarat_type_file);
        }
        return view('transaksi.create', compact('sublayanan','file_type','umum'));
    }

    public function syarat(string $skl_id)
    {
        try{
            $syarat = SyaratKategori::select('syarat_id', 'syarat_label', 'syarat_template', 'syarat_type', 'syarat_type_file')->where('syarat_kategori_id', $skl_id)->get();
            return response()->json($syarat);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $this->validate($request, [
                'skl_id' => 'required',
            ]);
    
            $user_id = auth()->user()->id;
            $input = [
                'users_id' => $user_id,
                'skl_id' => $request->skl_id,
                'pengajuan_detail' => $request->pengajuan_detail,
            ];
    
            $pengajuan = TrPengajuan::create($input);
            foreach ($request->input('document', []) as $file) {
                $input = [
                    'id_reference' => $user_id,
                    'pengajuan_id' => $pengajuan->id,
                    'berkas_file' => $file,
                    'berkas_status' => 'Belum Divalidasi',
                    'berkas_catatan' => '-',
                ];
                TrBerkas::create($input);
            }
            return redirect()->route('transaksi.index')->with('success', 'Pengajuan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataTable = new BerkasDataTable($id, auth()->user()->getRoleNames()[0]);
        return response()->json($dataTable->html());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajuan = TrPengajuan::find($id);
        $sublayanan = KategoriSublayanan::all();
        $dataTable = new BerkasDataTable($id, auth()->user()->getRoleNames()[0]);
        $umum = SyaratKategori::where('syarat_type', 'Umum')->get();
        $khusus = SyaratKategori::where('syarat_kategori_id', $pengajuan->skl_id)->get();
        $syarat = $umum->merge($khusus);
        $file_types = '';
        foreach ($syarat as $item) {
            $file_types .= str_replace(';', ',', $item->syarat_type_file);
        }
        return $dataTable->render('transaksi.edit', compact('pengajuan', 'sublayanan', 'syarat', 'khusus', 'umum', 'file_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'pengajuan_status' => 'required|in:Menunggu,Diproses,Ditolak,Selesai',
            ]);
            $pengajuan = TrPengajuan::find($id);
            $pengajuan->pengajuan_status = $request->pengajuan_status;
            $pengajuan->pengajuan_catatan = $request->pengajuan_catatan;
            $pengajuan->update();
            return redirect()->route('transaksi.index')->with('success', 'Status pengajuan berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('transaksi.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrPengajuan $trPengajuan)
    {
        //
    }
}
