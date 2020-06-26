@extends('backLayout.app')
@section('title')
All Products
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">All Products</div>
    <div class="panel-body" style="overflow: scroll;">
        <a href="{{ url('product/create') }}" class="btn btn-success">New Product</a>
        <div class="table">
            <table class="table table-bordered table-striped table-hover" id="tblroles">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Engineer Category</th>
                        <th>Group part or equipment</th>
                        <th>Engineering Application</th>
                        <th>Group description of part & equipment</th>
                        <th>Detail description of part & equipment</th>
                        <th>Part & Equipment Brand Name</th>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td>
                            @foreach ($category1 as $item)
                                @if ($item->id == $product->category1_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category2 as $item)
                                @if ($item->id == $product->category2_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category3 as $item)
                                @if ($item->id == $product->category3_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category4 as $item)
                                @if ($item->id == $product->category4_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category5 as $item)
                                @if ($item->id == $product->category5_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category5 as $item)
                                @if ($item->id == $product->category6_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $product->filename }}
                        </td>
                        <td>
                            @if (Sentinel::getUser()->id = $product->user_id)
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['product', $product->id],
                                'style' => 'display:inline'
                            ]) !!}    
                            @endif
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                            {!! Form::close() !!}
                            <a class="btn btn-success btn-xs detail_product" path="{{ $product->filepath }}" filename="{{ $product->filename }}">Property</a>
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <strong id="file_name" style="display:block; word-break: break-word;padding: 10px;"></strong>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#tblroles').DataTable({
            columnDefs: [{
                targets: [0],
                // visible: false,
                searchable: false
            },
            ],
            order: [[0, "asc"]],
        });
    });
    $(".deleteconfirm").on("click", function () {
        return confirm("Are you sure to delete this Role");
    });

    $('.detail_product').on("click", function(){
        $('#exampleModalCenter').modal();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var absolute_path = $(this).attr('path');
        var file_name = $(this).attr('filename');
        $.ajax({
            url: '/ajax_update',
            method: 'POST',
            data: { _token: CSRF_TOKEN, message: absolute_path, dimension:200 },
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
      if(size > 149 && size < 351){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size },
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
      if(size1 > 149 && size1 < 351){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size1 },
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