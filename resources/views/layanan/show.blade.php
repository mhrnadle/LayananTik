@extends('layouts.app')

@section('title', 'Layanan {{ $layanan->kl_label }}')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Layanan                    
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('layanan.index') }}"> Back</a>
            </div>
                </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Kategori Layanan :</strong>
                {{ $layanan->kl_label }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Kunker :</strong>
                {{ $layanan->kunker }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Status :</strong>
                @if ($layanan->kl_status == 1)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Non Aktif</span>
                @endif
            </div>
        </div>
    </div>

    <div class="card mb-4 mx-4">
        <div class="block justify-items-center mx-4">
            <div class="card-header pb-3">
                <h2>Sub Layanan</h2>
                <div class="d-flex flex-row justify-content-end">
                    @can('sublayanan-create')
                        <a type="button" class="btn bg-gradient-dark btn-sm mb-0" href="{{ route('sublayanan.create') }}">+&nbsp; Create Sub Layanan</a>
                    @endcan
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                {{$sublayanan->table()}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{ $sublayanan->scripts(attributes: ['type' => 'module']) }}
<script type="text/javascript">
  $(function () {
      
    var table = $('.kategorisublayanan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('layanan.sublayanan',$layanan->kl_id) }}",
        columns: [
            {data: 'skl_id', name: 'No'},
            {data: 'sub_layanan', name: 'Sub Layanan'},
            {data: 'status', name: 'status', searchable: false},
        ]
    });
      
  });
</script>
@endpush