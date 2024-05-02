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
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="{{route('users.create')}}" class="btn bg-gradient-dark btn-sm mb-0" type="button">+&nbsp; New User</a>
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

<dialog class="bg-transparent border-0" id="delete_user" aria-labelledby="delete-user">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="modal-header">
                  <h5 class="modal-title font-weight-normal" id="delete-user-label">
                      Delete data unit
                      <q id="delete-user-name"></q> 
                  </h5>
              </div>
              <form id="delete-user-form" role="form text-left" method="POST" action="" enctype="multipart/form-data">
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
          
        var table = $('.users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
          
      });

      const delete_user = document.getElementById('delete_user');
      const delete_name = document.getElementById('delete-user-name');
      const delete_form = document.getElementById('delete-user-form');
      delete_user.addEventListener('click', (event) => {
        if (event.target === delete_user) {
          delete_user.close();
        }
      });

      function deleteModal(id, name) {
        delete_name.innerHTML = name;
        delete_form.action = "{{ url('users') }}/" + id;
        delete_user.showModal();
      }

      function closeModal() {
        delete_name.innerHTML = '';
        delete_form.action = '';
        delete_user.close();
      }
    </script>
@endpush