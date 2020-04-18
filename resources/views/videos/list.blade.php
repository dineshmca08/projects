@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Video </h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#add"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
            <button type="button" class="d-none btn btn-sm btn-primary" data-toggle="modal" data-target="#alert">Add</button>
    </div>
    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Videos List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Category Type</th>
                            <th>Like Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $key => $value)
                        <tr>
                            <th>{{++$key}}</th>
                            <th>{{$value->name}}</th>
                            <th>{{$value->category->name}}</th>
                            <th>{{$value->videocategory->name}}</th>
                            <th>{{$value->like_count}}</th>
                            <th>
                                <a href="javascript:void(0);" class="btn btn-info btn-circle btn-sm edit-data" data-id="{{$value->id}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-circle btn-sm delete-data" data-id="{{$value->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="add">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Video</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="user" id="addForm" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="name" placeholder="Category" name="name">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="category" name="category">
                            <option>Select the Category</option>
                            @foreach($category as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="categorytype" name="categorytype">
                            <option>Select the Category Type</option>
                            @foreach($categoryType as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="url" placeholder="Url " name="url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="expirydate" placeholder="Expiry Date " name="expirydate">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-user" rows="3" id="description" name="description"></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="addRowButton" class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Video Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="user" id="editForm" method="POST">
                @csrf
                 <input type="hidden" name="data" id="editData">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="editname" placeholder="Category" name="name">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="editcategory" name="category">
                            <option>Select the Category</option>
                            @foreach($category as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="editcategorytype" name="categorytype">
                            <option>Select the Category Type</option>
                            @foreach($categoryType as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="editurl" placeholder="Url " name="url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="editexpirydate" placeholder="Expiry Date " name="expirydate">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-user" rows="3" id="editdescription" name="description"></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="editRowButton" class="btn btn-primary" >Update</button>
                 </div>
             </form>
        </div>
    </div>
</div>

<div class="modal" id="alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title messagetype"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body message">
                
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<style type="text/css">
    .error {
    color: #e74a3b;
    font-size: 1rem;
    position: relative;
    line-height: 1;
    width: 100%;
}
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.close').click(function(){
        location.reload(true);
    });

    /**Create Validation**/
    $("#addForm").validate({
        rules: {
            name:  {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
            category:  {
                        required: true,
                    },
            categorytype:  {
                        required: true,
                    },
            url:  {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
            expirydate:  {
                        required: false,
                    },
            description:  {
                        required: false,
                        minlength: 3,
                        maxlength: 75
                    },
        },
        submitHandler: function(form) {
            var data = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('videos.save') }}",
                data: data,
                dataType: "json",
                success: function(data) {
                    $("#alert").find(".messagetype").removeClass('text-success text-danger').html('');
                    $("#alert").find(".alert").remove();
                    if(data.success == 1){
                        form.reset();
                        $("#add").modal("toggle");
                        $("#alert").modal("toggle");
                        $("#alert").find(".messagetype").addClass('text-success').html('Alert Success');
                        $("#alert").find(".message").append('<div class="alert alert-success">'+data.message+'</div>');
                        
                    }else{
                        $("#add").modal("toggle");
                        $("#alert").modal("toggle");
                        $("#alert").find(".messagetype").addClass('text-danger').html('Alert Error');
                        var errors = data.errors;
                        if(Object.keys(errors).length > 0){
                            div='';
                            $.each(errors, function(index, error){
                                div +='<div class="alert alert-danger">'+error+'</div>';
                            });
                            $("#alert").find(".message").append(div);
                        }
                        else
                        {
                            $("#alert").find(".message").append('<div class="alert alert-success">'+data.message+'</div>');
                        }
                    }
                }
            }); 
        }
    }); 

    /**update Validation**/
    $("#editForm").validate({
        rules: {
            name:  {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
            category:  {
                        required: true,
                    },
            categorytype:  {
                        required: true,
                    },
            url:  {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
            expirydate:  {
                        required: false,
                    },
            description:  {
                        required: false,
                        minlength: 3,
                        maxlength: 75
                    },
        },
        submitHandler: function(form) {
            var data = $(form).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('videos.update') }}",
                data: data,
                dataType: "json",
                success: function(data) {
                    $("#alert").find(".messagetype").removeClass('text-success text-danger').html('');
                    $("#alert").find(".alert").remove();
                    if(data.success == 1){
                        form.reset();
                        $("#edit").modal("toggle");
                        $("#alert").modal("toggle");
                        $("#alert").find(".messagetype").addClass('text-success').html('Alert Success');
                        $("#alert").find(".message").append('<div class="alert alert-success">'+data.message+'</div>');
                        
                    }else{
                        $("#edit").modal("toggle");
                        $("#alert").modal("toggle");
                        $("#alert").find(".messagetype").addClass('text-danger').html('Alert Error');
                        var errors = data.errors;
                        if(Object.keys(errors).length > 0){
                            div='';
                            $.each(errors, function(index, error){
                                div +='<div class="alert alert-danger">'+error+'</div>';
                            });
                            $("#alert").find(".message").append(div);
                        }
                        else
                        {
                            $("#alert").find(".message").append('<div class="alert alert-success">'+data.message+'</div>');
                        }
                    }
                }
            }); 
        }
    }); 

    /**Edit record**/
    $("table").on("click", ".edit-data", function(){
        var editId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "{{route('videos.edit')}}",
            data: {data:editId},
            dataType: "json",
            success: function(response) {
                $("#alert").find(".messagetype").removeClass('text-success text-danger').html('');
                $("#alert").find(".alert").remove();
                if(response.success == 1){
                    var record = response.data;
                    $('#edit #editData').val(record.id);
                    $('#edit #editname').val(record.name);
                    $('#edit #editcategory').val(record.category_id).trigger("change");
                    $('#edit #editcategorytype').val(record.category_type).trigger("change");
                    $('#edit #editurl').val(record.url);
                    $('#edit #editexpirydate').val(record.expird_date);
                    $('#edit #editdescription').val(record.description);
                    $('#edit').modal();
                }
                else
                {
                    $("#edit").modal("toggle");
                    $("#alert").modal("toggle");
                    $("#alert").find(".messagetype").addClass('text-danger').html('Alert Error');
                    var errors = response.errors;
                    if(Object.keys(errors).length > 0){
                        div='';
                        $.each(errors, function(index, error){
                            div +='<div class="alert alert-danger">'+error+'</div>';
                        });
                        $("#alert").find(".message").append(div);
                    }
                    else
                    {
                        $("#alert").find(".message").append('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                }
            }
        }); 
    });

    /**Delete record**/
    $("table").on("click", ".delete-data", function(){
        var deleteId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "{{route('videos.delete')}}",
            data: {data:deleteId},
            dataType: "json",
            success: function(response) {
                $("#alert").find(".messagetype").removeClass('text-success text-danger').html('');
                $("#alert").find(".alert").remove();
                if(response.success == 1){
                    $("#alert").modal("toggle");
                    $("#alert").find(".messagetype").addClass('text-success').html('Alert Success');
                    $("#alert").find(".message").append('<div class="alert alert-success">'+response.message+'</div>');
                }
                else
                {
                    $("#alert").modal("toggle");
                    $("#alert").find(".messagetype").addClass('text-danger').html('Alert Error');
                    var errors = response.errors;
                    if(Object.keys(errors).length > 0){
                        div='';
                        $.each(errors, function(index, error){
                            div +='<div class="alert alert-danger">'+error+'</div>';
                        });
                        $("#alert").find(".message").append(div);
                    }
                    else
                    {
                        $("#alert").find(".message").append('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                }
            }
        }); 
    });
});
</script>
@endpush