<?php

namespace App\Http\Controllers;

use App\Models\InfoLayanan;
use App\Models\SyaratKategori;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = InfoLayanan::all();
        return view('guest.index', compact('info'));
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
    public function show(string $slug)
    {
        $info = InfoLayanan::where('layanan_slug', $slug)->first();
        $syarat = SyaratKategori::where('syarat_kategori_id', $info->kunker_pj)->get();
        $syarat_umum = SyaratKategori::where('syarat_type', 'Umum')->get();
        $syarat = $syarat_umum->merge($syarat);
        return view('guest.show', compact('info', 'syarat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
