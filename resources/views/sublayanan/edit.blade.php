@extends('layouts.app')

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
                <h2>Edit Sub Layanan

                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('layanan.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <form action="{{ route('sublayanan.update', $sublayanan->skl_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kategori Layanan :</strong>
                    <input type="text" name="skl_label" class="form-control" value="{{$sublayanan->skl_label}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Status Sublayanan:</strong>
                    <select name="skl_status" class="form-control">
                        <option value="1" {{ $sublayanan->skl_status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $sublayanan->skl_status == 0 ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Label Syarat :</strong>
                    <input type="text" name="syarat_label" class="form-control" value="{{$syarat_kategori->syarat_label ?? ''}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Tipe Status :</strong>
                    <select name="syarat_type" class="form-control">
                        <option value="Umum" {{ $syarat_kategori && $syarat_kategori->syarat_type == 'Umum' ? 'selected' : '' }}>Umum</option>
                        <option value="Khusus" {{ $syarat_kategori && $syarat_kategori->syarat_type == 'Khusus' ? 'selected' : '' }}>Khusus</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Tipe File Syarat :</strong>
                    <input type="text" name="syarat_type_file" class="form-control" value="{{$syarat_kategori->syarat_type_file ?? ''}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Status Syarat:</strong>
                    <select name="syarat_status" class="form-control">
                        <option value="1" {{ $syarat_kategori &&  $syarat_kategori->syarat_status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $syarat_kategori &&  $syarat_kategori->syarat_status == 0 ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Template Syarat :</strong>
                    <input type="text" name="syarat_template" class="form-control" value="{{$syarat_kategori->syarat_template ?? ''}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script type="text/javascript">
</script>
@endpush