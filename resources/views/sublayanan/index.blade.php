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
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="block justify-items-start">

                        <div class="row">
                            <div class="col mx-auto">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a href="{{route('layanan.index')}}" class="nav-link mb-0 px-2 py-1" role="tab" aria-controls="layanan" aria-selected="false">
                                        Layanan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link mb-0 px-2 py-1 active" role="tab" aria-controls="sublayanan" aria-selected="true">
                                        Sub Layanan
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-header pb-3">
                        <div class="d-flex flex-row justify-content-end">
                            @can('layanan-create')
                            <a type="button" class="btn bg-gradient-dark btn-sm mb-0" href="{{ route('sublayanan.create') }}">+&nbsp; Create Sub Layanan</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3">
                            {{ $dataTable->table() }}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog class="bg-transparent border-0" id="delete_modal" aria-labelledby="delete-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="delete-user-label">
                            Delete data unit
                            <q id="delete-label"></q> 
                        </h5>
                    </div>
                    <form id="delete-form" role="form text-left" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <button type="button" onclick="closeModal()" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button autofocus type="submit" class="btn bg-gradient-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </dialog>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="text/javascript">
      $(function () {
          
        var table = $('.kategorisublayanan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sublayanan.index') }}",
            columns: [
                {data: 'skl_id', name: 'No'},
                {data: 'sub_layanan', name: 'Sub Layanan'},
                {data: 'status', name: 'status', searchable: false},
            ]
        });
          
      });
      const delete_modal = document.getElementById('delete_modal');
      const delete_name = document.getElementById('delete-label');
      const delete_form = document.getElementById('delete-form');
      delete_modal.addEventListener('click', (event) => {
        if (event.target === delete_modal) {
          delete_modal.close();
        }
      });

      function deleteModal(id, label) {
        delete_name.innerHTML = label;
        delete_form.action = "{{ url('layanan') }}/" + id;
        delete_modal.showModal();
      }

      function closeModal() {
        delete_name.innerHTML = '';
        delete_form.action = '';
        delete_modal.close();
      }
    </script>
@endpush