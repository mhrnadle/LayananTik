@extends('layouts.app')

@section('title', 'Create Layanan')

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
                <h2>Edit Info Layanan
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('info-layanan.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @can('infolayanan-edit')
    <form action="{{ route('info-layanan.update', $infoLayanan->layanan_id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Nama Info Layanan :</strong>
                    <input type="text" name="layanan_nama" class="form-control" value="{{$infoLayanan->layanan_nama}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Deskripsi :</strong>
                    <textarea name="layanan_desc" class="form-control">{{$infoLayanan->layanan_desc}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Apk Layanan :</strong>
                    <input type="text" name="layanan_apk" class="form-control" value="{{$infoLayanan->layanan_apk}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Status :</strong>
                    <select name="layanan_status" class="form-control">
                        <option value="1" {{$infoLayanan->layanan_status == 1 ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$infoLayanan->layanan_status == 0 ? 'selected' : ''}}>Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>SOP Layanan :</strong>
                    <textarea name="layanan_sop" class="form-control">{{$infoLayanan->layanan_sop}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    @endcan
@endsection