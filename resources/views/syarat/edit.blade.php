@extends('layouts.app')

@section('title', 'Create Sub Layanan')

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
                <h2>Create Sub Layanan
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('syarat.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    <form action="{{ route('syarat.update', $syarat->syarat_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Label Syarat :</strong>
                    <input type="text" name="syarat_label" class="form-control" value="{{$syarat->syarat_label}}">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Tipe :</strong>
                    <select id="syarat_type" name="syarat_type" class="form-control">
                        <option value="Umum" {{$syarat->syarat_type == 'Umum' ? 'selected' : ''}}>Umum</option>
                        <option value="Khusus" {{$syarat->syarat_type == 'Khusus' ? 'selected' : ''}}>Khusus</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kategori Sub Layanan :</strong>
                    <select id="syarat_kategori_id" name="syarat_kategori_id" class="form-control" {{$syarat->syarat_type == "Umum" ? 'disabled' : ""}}>
                        @foreach ($sublayanan as $item)
                            <option value="{{$item->skl_id}}" {{$item->skl_id == $syarat->syarat_kategori_id ? 'selected' : ''}}>{{$item->skl_label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="row ps-3">
                    <strong>Tipe File :</strong>
                        <br />
                    @foreach($type_file as $value)
                        <div class="form-check col-md-3 col-sm-2 col-3">
                            <input class="form-check-input" type="checkbox" name="syarat_type_file[]" value="{{ $value }}" id="flexCheck{{$value}}" {{ in_array($value, explode(';', $syarat->syarat_type_file)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheck{{$value}}">
                                {{ $value }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Template Syarat :</strong>
                    <input type="file" id="syarat_template" name="syarat_template" class="form-control" placeholder="Template Syarat" accept="@foreach($type_file as $value){{ $value }},@endforeach">
                </div>
                <a href="{{ asset('templates/'.$syarat->syarat_template) }}" target="_blank" class="btn btn-primary btn-sm">Lihat Template</a>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Status :</strong>
                    <select id="syarat_status" name="syarat_status" class="form-control">
                        <option value=0>Non Aktif</option>
                        <option value=1>Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        var syarat_type = document.getElementById('syarat_type');
        var syarat_kategori_id = document.getElementById('syarat_kategori_id');
        syarat_type.addEventListener('change', function() {
            if (this.value === 'Khusus') {
                syarat_kategori_id.disabled = false;
                syarat_kategori_id.selectedIndex = 0;
            } else {
                syarat_kategori_id.disabled = true;
                syarat_kategori_id.value = '';
            }
        });

        var syarat_type_file = document.getElementsByName('syarat_type_file[]');
        var syarat_template = document.getElementById('syarat_template');
        syarat_type_file.forEach(function(item) {
            item.addEventListener('change', function() {
                var accept = '';
                syarat_type_file.forEach(function(item) {
                    if (item.checked) {
                        accept += item.value + ',';
                    }
                });
                syarat_template.accept = accept;
            });
        });
    </script>
@endpush