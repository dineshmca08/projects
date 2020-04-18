@extends('layouts.user')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$videos->name}} </h1>
        <button type="button" class="d-none btn btn-sm btn-primary" data-toggle="modal" data-target="#alert">Add</button>
    </div>
    <!-- Content Row -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Videos</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @if($videos->category_type==2)
                    @if(strtotime($videos->expiry_date) >= strtotime(date('Y-m-d')))
                        <iframe id="firstembed" width="100%" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                    @endif
                @else
                    <iframe id="firstembed" width="100%" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                @endif
            </div>
            <div class="row">
                <div class="col-8 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Description</h6>
                        </div>
                        <div class="card-body">
                          {{$videos->description}}
                        </div>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <a href="javascript:void(0);" class="btn btn-success btn-icon-split like mf-5" data-id="{{$videos->id}}">
                        <span class="icon text-white-50">
                          <i class="fas fa-heart"></i>
                        </span>
                        <span class="text">{{$videos->like_count}}</span>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm subscribe {{$videos->category_type!=2?'d-none':''}}" data-id="{{$videos->id}}">Subscribe
                    </a>
                </div>
            </div>
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

</style>

@endpush
@push('script')
<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.ytp-large-play-button').on('click',function(){
        console.log('start');
    });
    $('.close').click(function(){
        location.reload(true);
    });
    /**Like count**/
    $("body").on("click", ".like", function(){
        var likeId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "{{route('user.like')}}",
            data: {data:likeId},
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
                    $("#alert").find(".message").append('<div class="alert alert-danger">'+response.message+'</div>');
                   
                }
            }
        }); 
    });

    /**Like count**/
    $("body").on("click", ".subscribe", function(){
        var likeId = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "{{route('user.subscribe')}}",
            data: {data:likeId},
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
                    $("#alert").find(".message").append('<div class="alert alert-danger">'+response.message+'</div>');
                   
                }
            }
        }); 
    });
});
</script>
@endpush