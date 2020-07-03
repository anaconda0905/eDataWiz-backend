@extends('backLayout.app')
@section('title')
Products
@stop

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">Products</div>
    <div class="panel-body">
        {{-- <a href="{{ route('questions.create') }}" class="btn btn-default">New Product</a> --}}
        {{-- <a href="{{ route('categories.index') }}" class="btn btn-default">Categories</a> --}}

        @if(sizeof($questions) > 0)
        <div class="table-responsive"> 
            <table class="table table-striped table-bordered" id="question-table">
                <thead>  
                <tr>
                    <th>No</th>
                    <th>Engineer Category</th>
                    <th>Group part or equipment</th>
                    <th>Engineering Application</th>
                    <th>Group description of part & equipment</th>
                    <th>Detail description of part & equipment</th>
                    <th>Part & Equipment Brand Name</th>
                    <th>File Name</th>
                    <th>More</th>
                </tr>
                </thead>  
                @foreach ($questions as $k => $question)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $question->general->pd_general }}</td>
                        <td>{{ $question->classification->pd_classification}}</td>
                        <td>{{ $question->header->pd_header }}</td>

                        @if ($question->pdList)
                            <td>{{ $question->pdList->pd_list }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        
                        @if ($question->dpdList)
                            <td>{{ $question->dpdList->dpd_list }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        
                        @if ($question->brand)
                            <td>{{ $question->brand->pd_brand }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        <td>{{ $question->filename }}</td>                    
                        
                        <td>
                            <a class="btn btn-success btn-xs detail_product" path="{{ $question->filepath }}" filename="{{ $question->filename }}">Property</a>

                            @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                            <a class="btn btn-xs btn-primary" href="{{ route('questions.edit',$question->id) }}">Edit</a>
                            <button  class="btn btn-xs btn-danger delete-question-btn"  data-id="{{$question->id}}">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        @else
            <div class="alert alert-alert">Start Adding to the Database.</div>
        @endif
    </div>
</div>

<div class="modal fade" id="delete-question-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Do you reall want to delete items?
            </div>
            
            <form action="/deleteQuestion" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="delete-question-id" name="id">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Properties</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center qrcode">
            <img id="qrcodeimage" style="-webkit-user-drag: none; border: 1px solid lightgray;" src=""><br/>
            <input type="hidden" id="img_size" value="200"/>
            <input type="hidden" id="qrcodeimage_url" value="200"/>
            <strong><a id="img_size_minus"><i class="fa fa-search-minus"></i></a>&nbsp;&nbsp;<b id="img_dimension">200*200</b>&nbsp;&nbsp;<a id="img_size_plus"><i class="fa fa-search-plus"></i></a></strong>  
            <br/>
            <br/>
            <strong id="file_name" style="display:none; word-break: break-word;padding: 10px;"></strong>
            <a id="qrcodeimage_download" class="btn btn-success" download="frame.png" href=""><i class="fa fa-download"></i>&nbsp;Download QRcode</a>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script >
    $(document).ready(function() {
        $('#question-table').DataTable();
    } );
    $(".delete-question-btn").on("click",function(){
        var id = $(this).data("id");
        $("#delete-question-id").val(id);
        $('#delete-question-modal').modal('toggle');
    });
    $('.detail_product').on("click", function(){
        $('#exampleModalCenter').modal();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var absolute_path = $(this).attr('path');
        var file_name = $(this).attr('filename');
        $.ajax({
            url: '/ajax_update',
            method: 'POST',
            data: { _token: CSRF_TOKEN, message: absolute_path, dimension:200, filename:file_name },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                $('#qrcodeimage').attr("src", data.msg);
                $('#qrcodeimage_url').val(absolute_path);
                $('#img_dimension').text("200*200");
                $('#file_name').text(file_name);
                $('#qrcodeimage_download').attr("href", data.msg);
            }
        });
    });

    $('#img_size_minus').on('click', function(){
      var size = parseInt($('#img_size').val()) - 50;
      if(size > 149 && size < 251){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size, filename:$('#file_name').text() },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            $('#qrcodeimage').attr("src", data.msg);
            $('#qrcodeimage_download').css("display", "block");
            $('#qrcodeimage_download').attr("href", data.msg);
          }
        });
        $('#img_size').val(size);
        $('#img_dimension').text(size + "*" +size);
      }
    });
    $('#img_size_plus').on('click', function(){
      var size1 = parseInt($('#img_size').val()) + 50;
      if(size1 > 149 && size1 < 251){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size1, filename:$('#file_name').text() },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            $('#qrcodeimage').attr("src", data.msg);
            $('#qrcodeimage_download').css("display", "block");
            $('#qrcodeimage_download').attr("href", data.msg);
          }
        });
        $('#img_size').val(size1);
        $('#img_dimension').text(size1 + "*" +size1);
      }
    });
</script>

@endsection