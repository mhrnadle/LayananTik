@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Create New User
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Hans Bonatua">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Username:</strong>
                    <input type="text" name="username" class="form-control" placeholder="HansBb">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>No Telp:</strong>
                    <input type="text" name="no_telp" class="form-control" placeholder="0811.....">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Alamat:</strong>
                    <input type="text" name="alamat" class="form-control" placeholder="Jl ....">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Active Status:</strong>
                    <select class="form-control" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Tipe Akun:</strong>
                    <select class="form-control" name="is_active">
                        <option value="1">OPD</option>
                        <option value="2">User ASN</option>
                        <option value="3">User instansi lain</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>NIP:</strong>
                    <input type="text" name="nip" class="form-control" placeholder="Diisi bila tipe akun User ASN">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ID Pegawai:</strong>
                    <input type="text" name="id_peg" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Kunker:</strong>
                    <input type="text" name="kunker" class="form-control" placeholder="Diisi bila tipe akun OPD">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select class="form-control multiple" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection