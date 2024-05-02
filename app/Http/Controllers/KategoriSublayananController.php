<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriSubLayananDataTable;
use App\Models\KategoriLayanan;
use App\Models\KategoriSublayanan;
use App\Models\SyaratKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriSublayananController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:sublayanan-list|sublayanan-create|sublayanan-edit|sublayanan-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:sublayanan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:sublayanan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:sublayanan-delete'], ['only' => ['destroy']]);
    }

    public function index(KategoriSubLayananDataTable $dataTableSubLayanan)
    {
        return $dataTableSubLayanan->render('layanan.index');
    }
    
    public function indexById(string $id)
    {
        $sublayanan = KategoriSublayanan::where('kl_id', $id)->get();
        return DataTables::collection($sublayanan)
            ->addColumn('action', function ($item) {
                $status_tooltip = $item->skl_status == 1 ? "Turn Off" : "Turn On";
                $label = htmlentities($item->skl_label, ENT_QUOTES, 'UTF-8');
                $type = htmlentities("sublayanan", ENT_QUOTES, 'UTF-8');
                return '<a class="btn btn-info my-auto p-2 rounded-1" href="'.route('sublayanan.show',$item).'" data-toggle="tooltip" title="'.$status_tooltip.'"><i class="fas fa-power-off text-white m-0"></i></a>
                        <a class="btn btn-primary my-auto p-2 rounded-1" href="'.route('sublayanan.edit',$item).'"><i class="fas fa-user-edit text-white m-0"></i></a>
                        <button class="btn btn-danger my-auto p-2 rounded-1" onclick="deleteModal('.$item->skl_id.',\''.$label.'\',\''.$type.'\')"><i class="fas fa-trash-alt text-white m-0"></i></button>';
            })
            ->addColumn('status', function ($item) {
                return $item->skl_status == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Non Aktif</span>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sublayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // cek if skl_status == 1 if 0 change to 1 else change to 0
        $sublayanan = KategoriSublayanan::find($id);
        if(!$sublayanan) {
            return redirect()->back()->with('error', "Sublayanan not found.");
        }
        $sublayanan->skl_status = $sublayanan->skl_status == 1 ? 0 : 1;
        $sublayanan->save();
        return redirect()->back()->with('success', "Sublayanan ".$sublayanan->skl_label." updated successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sublayanan = KategoriSublayanan::find($id);
        $syarat_kategori = SyaratKategori::where('syarat_kategori_id', $id)->first();
        return view('sublayanan.edit', compact('sublayanan', 'syarat_kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $this->validate($request, [
                'skl_label' => 'required',
                'skl_status' => 'required',
                'syarat_label' => 'required',
                'syarat_type' => 'required|in:Umum,Khusus',
                'syarat_type_file' => 'required',
                'syarat_status' => 'required',
                'syarat_template' => 'required',
            ]);

            $sublayanan = KategoriSublayanan::find($id);
            if(!$sublayanan) {
                return redirect()->back()->with('error', "Sublayanan not found.");
            }

            $data_sub = [
                'skl_label' => $request->skl_label,
                'skl_status' => $request->skl_status,
                'updated_by' => auth()->user()->id
            ];
            $sublayanan->update($data_sub);

            $syarat_kategori = SyaratKategori::where('syarat_kategori_id', $id)->first();
            if(!$syarat_kategori){
                $data_syarat = [
                    'syarat_label' => $request->syarat_label,
                    'syarat_kategori_id' => $id,
                    'syarat_type' => $request->syarat_type,
                    'syarat_type_file' => $request->syarat_type_file,
                    'syarat_status' => $request->syarat_status,
                    'syarat_template' => $request->syarat_template,
                    'created_by' => auth()->user()->id,
                ];
                SyaratKategori::create($data_syarat);
                return redirect()->back()->with('success', "Sublayanan ".$data_sub['skl_label']." updated successfully.");
            }

            $data_syarat = [
                'syarat_label' => $request->syarat_label,
                'syarat_type' => $request->syarat_type,
                'syarat_type_file' => $request->syarat_type_file,
                'syarat_status' => $request->syarat_status,
                'syarat_template' => $request->syarat_template,
                'updated_by' => auth()->user()->id,
            ];
            $syarat_kategori->update($data_syarat);
            return redirect()->back()->with('success', "Sublayanan ".$data_sub['skl_label']." updated successfully.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = KategoriSublayanan::find($id);
        $user->delete();
        return redirect()->back()->with('success', "Sublayanan ".$user->skl_label." deleted successfully.");
    }
}
