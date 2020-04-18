@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Subscribe User</h1>
        <a href="{{route('pdf')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> PDF</a>
    </div>
    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Expiry Date</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $key => $value)
                        <tr>
                            <th>{{++$key}}</th>
                            <th>{{$value->usersubscribe->name}}</th>
                            <th>{{$value->usersubscribe->expiry_date}}</th>
                            <th>{{$value->user->name}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')

</style>
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset('js/demo/datatables-demo.js') }}" defer></script>
<script src="{{ asset('vendor/validate/jquery.validate.min.js') }}" defer></script>
<script type="text/javascript">
$(document).ready(function() {
    
});
</script>
@endpush