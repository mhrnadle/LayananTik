@extends('layouts.app')

@section('title', 'Create Aset')

@section('content')
@if(session('success') || session('error'))
    <div class="toast align-items-center text-white {{session('success') ? "bg-success" : "bg-danger" }} show border-0 top-5 end-3 position-absolute" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 100">
        <div class="d-flex">
        <div class="toast-body">
            {{session('success')}} {{session('error')}}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Create New Aset
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('aset.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <form action="{{ route('aset.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Nama Aset :</strong>
                    <input type="text" name="NamaAset" class="form-control" placeholder="Nama Aset">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Deskripsi :</strong>
                    <textarea name="Deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ID Lokasi :</strong>
                    <select class="form-control" name="IDLokasi" placeholder="Masukkan ID Lokasi">
                        <option value="">- Pilih Lokasi -</option>
                        @foreach ($lokasiaset as $item)
                            <option value="{{ $item -> id }}">{{ $item->NamaLokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kondisi :</strong>
                    <select name="layanan_status" class="form-control">
                        <option value="1">Baik</option>
                        <option value="0">Kurang Baik</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Catatan :</strong>
                    <textarea name="Catatan" class="form-control" placeholder="Catatan"></textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection