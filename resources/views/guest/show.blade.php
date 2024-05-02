@extends('layouts.guest')

@section('title', 'Info Layanan ' . $info->layanan_nama)

@section('content')

    <main class="album py-5 bg-body-tertiary">
        <div class="container">
            <a href="/" class="btn bg-gradient-primary btn-lg">Kembali</a>
            <a href="{{route('transaksi.create')}}" class="btn bg-gradient-info btn-lg">lakukan pengajuan</a>

            <div class="row">
                <div class="d-flex flex-column">
                    <h1>{{$info->layanan_nama}}</h1>
                    <p>{{$info->layanan_desc}}</p>
                    <p>{{$info->layanan_sop}}</p>
                    <div class="row">
                        <h4>Syarat File</h4>
                        @foreach($syarat as $item)
                        <a href="/templates/{{$item->syarat_template}}" target="blank" class="col-md-4">
                            <div class="card" style="min-height: 100%">
                            <div class="card-body">
                                <h5 class="card-title">
                                {{$item->syarat_label}}
                                </h5>
                                <p class="card-text">
                                {{str_replace(';',', ',$item->syarat_type_file)}}
                                </p>
                            </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection