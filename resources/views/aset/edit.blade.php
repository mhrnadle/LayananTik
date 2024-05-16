@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Edit Aset

                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('aset.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <form action="{{ route('aset.update', $aset->aset_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Nama Aset :</strong>
                    <input type="text" name="namaaset_label" class="form-control" value="{{$aset->NamaAset}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Jenis Aset :</strong>
                    <input type="text" name="jenisaset" class="form-control" value="{{$aset->JenisAset}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Deskripsi :</strong>
                    <input type="text" name="deskripsi" class="form-control" value="{{$aset->Deskripsi}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ID Lokasi :</strong>
                    <input type="number" name="IDLokasi" class="form-control" value="{{$aset->IDLokasi}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ID Kategori :</strong>
                    <input type="number" name="IDKategori" class="form-control" value="{{$aset->IDKategori}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kondisi :</strong>
                    <select name="kondisi_status" class="form-control">
                        <option value="1" {{ $aset->kondisi_status == 1 ? 'selected' : '' }}>Baik</option>
                        <option value="0" {{ $aset->kondisi_status == 0 ? 'selected' : '' }}>Tidak Baik</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Tanggal Pembelian :</strong>
                    <input type="date" name="TanggalPembelian" class="form-control" value="{{$aset->TanggalPembelian}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection