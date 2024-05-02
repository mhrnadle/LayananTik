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
                <h2>Edit Pengajuan
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('transaksi.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
       <div class="card-body">                    
        <form action="{{ route('transaksi.update', $pengajuan->pengajuan_id) }}" method="POST" enctype="multipart/form-data" id="dropzone-form">
            @method('POST')
            @csrf
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <label for="layananSelect">Layanan :</label>
                    <select name="skl_id" class="form-control" id="layananSelect">
                        <option value="">Pilih Layanan</option>
                        @foreach ($sublayanan as $item)
                            <option value="{{$item->skl_id}}" {{$item->skl_id == $pengajuan->skl_id ? "selected" : ""}}>
                                {{$item->skl_label}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="pengajuan_detail">Detail Pengajuan</label>
                <textarea name="pengajuan_detail" id="pengajuan_detail" class="form-control">{{$pengajuan->pengajuan_detail}}</textarea>
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
                    @foreach ($khusus as $item)
                      <li>
                        <a href="/templates/{{$item->syarat_template}}" target="blank">{{$item->syarat_label}}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
                  {{ $dataTable->table() }}
              </div> 
            </div>
            <div class="form-group">
                <label for="document-dropzone">Upload Berkas Baru Disini</label>
                <div class="needsclick dropzone" id="document-dropzone">
            </div>
            <button type="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>

    <dialog class="bg-transparent border-0" id="status-modal" aria-labelledby="status-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">
                  <div class="modal-header">
                      <h5 class="modal-title font-weight-normal" id="status-modal-label">
                          Update status pengajuan
                          <q id="status-label"></q> 
                      </h5>
                  </div>
                  <form id="status-form" role="form text-left" method="POST" action="" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <label for="pengajuan_status">Status</label>
                        <select class="form-select" name="pengajuan_status" id="pengajuan_status">
                            <option value="Menunggu">Menunggu</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <label for="pengajuan_catatan">Catatan Pengajuan</label>
                        <textarea class="form-control" name="pengajuan_catatan" id="pengajuan_catatan" rows="3"></textarea>
                      <div class="modal-footer">
                          <button type="button" onclick="closeModal()" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                          <button autofocus type="submit" class="btn bg-gradient-success">Update</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </dialog>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    // dropzone
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
      url: "{{ route('uploads') }}",
      maxFilesize: 2, // MB
      acceptedFiles: {!! json_encode($file_types) !!},
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
    // syarat khusus
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
      $(function () {
        var table = $('.berkas-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi.show', ':id') }}".replace(':id', {{$pengajuan->pengajuan_id}}),
            columns: [
                {data: 'id', name: 'id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
          
      });

        const status_modal = document.getElementById('status-modal');
        const status_name = document.getElementById('status-label');
        const status_form = document.getElementById('status-form');
        status_modal.addEventListener('click', (event) => {
            if (event.target === status_modal) {
                status_modal.close();
            }
        });

        function statusModal(id, label) {
            status_name.innerHTML = label;
            status_form.action = "{{ route('transaksi.update', ':id') }}".replace(':id', {{$pengajuan->pengajuan_id}});
            status_modal.showModal();
        }

        function closeModal() {
            status_name.innerHTML = '';
            status_form.action = '';
            status_modal.close();
        }
  </script>
@endpush