<?php

namespace App\Http\Controllers;

use App\Models\TrBerkas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function uploadBerkas(Request $request)
    {
        // $path = storage_path('tmp/uploads');

        // !file_exists($path) && mkdir($path, 0777, true);

        // $file = $request->file('file');
        // $name = uniqid() . '_' . trim($file->getClientOriginalName());
        // $filepath = $file->storeAs('uploads', $name, 'public');
        // return response()->json([
        //     'name'          => $name,
        //     'original_name' => $file->getClientOriginalName(),
        //     'path'          => $filepath,
        // ]);
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move(public_path('uploads'), $name);
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(TrBerkas $trBerkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrBerkas $trBerkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrBerkas $trBerkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrBerkas $trBerkas)
    {
        //
    }
}
