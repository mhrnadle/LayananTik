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
                <div class="card-header pb-3">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Semua Pengajuan</h5>
                        </div>
                        {{-- @can('pengajuan-create') --}}
                        @if(auth()->user()->id == 1)
                            
                        @else
                        <a href="{{route('transaksi.create')}}" class="btn bg-gradient-dark btn-sm mb-0" type="button">+&nbsp; Pengajuan</a>
                        @endif
                        {{-- @endcan --}}
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
                  <h5 class="modal-title font-weight-normal" id="delete-modal-label">
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
    <script type="text/javascript">
      $(function () {
          
        var table = $('.transaksi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
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
            delete_form.action = "{{ url('transaksi') }}/" + id;
            delete_modal.showModal();
        }

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
            status_form.action = "{{ route('transaksi.update', ':id') }}".replace(':id', id);
            status_modal.showModal();
        }

        function closeModal() {
            delete_name.innerHTML = '';
            delete_form.action = '';
            delete_modal.close();
            status_name.innerHTML = '';
            status_form.action = '';
            status_modal.close();
        }
    </script>
@endpush