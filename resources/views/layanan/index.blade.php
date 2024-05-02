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
                    <div class="block justify-items-center">

                        <div class="row">
                            <div class="col mx-auto">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a href="#layanan" class="nav-link mb-0 px-2 py-1 active" role="tab" aria-controls="layanan" aria-selected="true">
                                        Layanan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sub-layanan" class="nav-link mb-0 px-2 py-1" role="tab" aria-controls="sublayanan" aria-selected="true">
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
                            <a id="layanan_btn" type="button" class="btn bg-gradient-dark btn-sm mb-0" href="{{ route('layanan.create') }}">+&nbsp; Create Kategori Layanan</a>
                            @endcan
                            @can('sublayanan-create')
                            <a id="sub_layanan_btn" type="button" class="btn bg-gradient-dark btn-sm mb-0 d-none" href="{{ route('sublayanan.create','q=1') }}">+&nbsp; Create Sub Layanan</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3" id="layanan_table">
                            {{ $dataTable->table() }}
                        </div> 
                        <div class="table-responsive p-3 d-none" id="sub_layanan_table">
                            {{  $dataTableSubLayanan->table() }}
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
    {{ $dataTableSubLayanan->scripts(attributes: ['type' => 'module']) }}
    <script type="text/javascript">
        $(function () {
            
        var table = $('.kategorilayanan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('layanan.table') }}",
            columns: [
                {data: 'kl_id', name: 'No'},
                {data: 'kunker', name: 'kunker'},
                {data: 'kl_label', name: 'kl_label'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
        });

        var table_2 = $('.kategorisublayanan-table').DataTable({
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

        function deleteModal(id, label, eventType) {
        delete_name.innerHTML = label;
        if(eventType == 'layanan'){
            delete_form.action = "{{ url('layanan') }}/" + id;
        }else{
            delete_form.action = "{{ url('sublayanan') }}/" + id;
        }
        delete_modal.showModal();
        }

        function closeModal() {
        delete_name.innerHTML = '';
        delete_form.action = '';
        delete_modal.close();
        }

        document.querySelectorAll('.nav-link').forEach(item => {
            item.addEventListener('click', event => {
                var layanan_table = document.getElementById('layanan_table');
                var sub_layanan_table = document.getElementById('sub_layanan_table');
                var layanan_btn = document.getElementById('layanan_btn');
                var sub_layanan_btn = document.getElementById('sub_layanan_btn');
                if(event.target.getAttribute('href') == '#layanan'){
                    layanan_table.classList.remove('d-none');
                    layanan_btn.classList.remove('d-none');
                    sub_layanan_table.classList.add('d-none');
                    sub_layanan_btn.classList.add('d-none');
                }else{
                    layanan_table.classList.add('d-none');
                    layanan_btn.classList.add('d-none');
                    sub_layanan_table.classList.remove('d-none');
                    sub_layanan_btn.classList.remove('d-none');
                }
            })
        })
        // refactored code above to use forEach
        
    </script>
@endpush