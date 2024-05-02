@extends('layouts.app')

@section('title', 'Create Sub Layanan')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Create Sub Layanan
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('layanan.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kategori Layanan :</strong>
                    <input type="text" name="kl_label" class="form-control" placeholder="Kategori Layanan">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kunker :</strong>
                    <input type="text" name="kunker" class="form-control" placeholder="Kategori Layanan">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Status :</strong>
                    <select name="kl_status" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection