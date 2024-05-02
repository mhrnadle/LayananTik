@extends('layouts.app')

@section('title', 'Create Sub Layanan')

@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endsection
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
                <h2>Buat Pengajuan
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('transaksi.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
       <div class="card-body">                    
        <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" id="dropzone-form">
            @method('POST')
            @csrf
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <label for="layananSelect">Layanan :</label>
                    <select name="skl_id" class="form-control" id="layananSelect">
                        <option value="pilih">Pilih Layanan</option>
                        @foreach ($sublayanan as $item)
                            <option value="{{$item->skl_id}}">{{$item->skl_label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
              <label for="pengajuan_detail">Detail Pengajuan</label>
              <textarea name="pengajuan_detail" id="pengajuan_detail" class="form-control"></textarea>
            </div>
            <div class="d-flex mb-3">
              <div>
                <label>Syarat Umum</label>
                <ul id="syarat-umum" class="d-flex flex-column">
                  @foreach ($umum as $item)
                    <li>
                      <a href="/template/{{$item->syarat_template}}" target="blank">{{$item->syarat_label}}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="mx-5">
                <label>Syarat Khusus</label>
                <ul id="syarat-khusus" class="d-flex flex-column">

                </ul>
              </div>
            </div>
            <div class="form-group">
                <label for="document-dropzone">Upload Berkas</label>
                <div class="needsclick dropzone" id="document-dropzone">
            </div>
            <button type="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    var uploadedDocumentMap = {}
    var acceptFiles = {!! json_encode($file_type) !!}
    Dropzone.options.documentDropzone = {
      url: "{{ route('uploads') }}",
      maxFilesize: 2, // MB
      acceptedFiles: acceptFiles,
      addRemoveLinks: true,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function (file, response) {
        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
      },
      removedfile: function (file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
          name = file.file_name
        } else {
          name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="document[]"][value="' + name + '"]').remove()
      },
      init: function () {
        @if(isset($project) && $project->document)
          var files =
            {!! json_encode($project->document) !!}
          for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
          }
        @endif
      }
    }
    document.getElementById('layananSelect').addEventListener('change', function() {
    var skl_id = this.value;
    fetch("{{ route('transaksi.syarat', ':skl_id') }}".replace(':skl_id', skl_id))
        .then(response => response.json())
        .then(data => {
            document.getElementById('syarat-khusus').innerHTML = '';
            for (let i = 0; i < data.length; i++) {
              console.log(data[i].syarat_label);
                document.getElementById('syarat-khusus').innerHTML += `<li><a target="blank" href="/templates/${data[i].syarat_template}">${data[i].syarat_label}</a></li>`;
                if (data[i].syarat_type_file == 1) {
                    acceptFiles += `,${data[i].syarat_type_file}`;
                } 
            }
        });
    });
  </script>
@endpush