@extends('backLayout.app')
@section('title')
Category
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Category</div>
    <div class="panel-body">
        <a href="{{ url('category/create') }}" class="btn btn-success">New Category</a>
        <div class="table">
            <table class="table table-bordered table-striped table-hover" id="tblroles">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subcategory</th>
                        <th>Subcategory Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('category', $item->id) }}">{{ $item->name }}</a></td>
                        <td>
                            @php $current_subcategories = array(); $current_subcategories_id = array(); @endphp
                            @foreach($subcategories as $subitem)
                                @if($subitem->category == $item->id)
                                    @php 
                                        array_push($current_subcategories, $subitem->name); 
                                        $tmp = array('id' => $subitem->id);
                                        array_push($current_subcategories_id, $tmp); 
                                    @endphp
                                @endif
                            @endforeach
                            {!! Form::select('category', $current_subcategories, null, ['class' => 'form-control subcat'], $current_subcategories_id) !!}
                        </td>
                        <td>
                            <a class="btn btn-primary btn-xs add_sub_cat">Add</a>
                            <a class="btn btn-success btn-xs edit_sub_cat">Edit</a>
                            <a class="btn btn-danger btn-xs delete_sub_cat">Delete</a>
                        </td>
                        <td>
                            <a href="{{route('user.index',['type='.$item->name])}}" class="btn btn-primary btn-xs">View
                                Products</a>
                            <a href="{{ url('category/' . $item->id . '/edit') }}"
                                class="btn btn-success btn-xs">Edit</a>
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['category', $item->id],
                            'style' => 'display:inline'
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="sub_cat_add_modal" tabindex="-1" role="dialog" aria-labelledby="sub_cat_add_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sub_cat_add_modalLabel">Add Subcategory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="subcatname">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="cat_id" value=""/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_sub_cat_perfom">Add</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="sub_cat_edit_modal" tabindex="-1" role="dialog" aria-labelledby="sub_cat_edit_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sub_cat_edit_modalLabel">Edit Subcategory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" id="subcateditname">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="edit_subcat_id" value=""/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary edit_sub_cat_perfom">Update</button>
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
        return confirm("Are you sure to delete this Category");
    });

    $('.delete_sub_cat').on("click", function(){
      var subcat_id = $(this).parent().parent().find('.subcat').children(":selected").attr('id');
      if(subcat_id){
            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok, Delete it!'
            }).then(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/ajax_sub_cat_delete',
                    method: 'POST',
                  data: { _token: CSRF_TOKEN, message: subcat_id },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        swal(
                            'Deleted!',
                            'Subcategory has been deleted.',
                            'success'
                        );
                        setTimeout( function() {
                            location.reload(true);
                        }, 1000);
                    }
                });
            })
        }
    });

    $('.add_sub_cat').on("click", function(){
      var cat_id = $(this).parent().parent().find('.sorting_1').text();
      if(cat_id) {
            $('#sub_cat_add_modal').modal();
            $('#cat_id').val(cat_id);
        }
    });

    $('.add_sub_cat_perfom').on('click', function(){
        $('#sub_cat_add_modal').modal('toggle');
        if($('#subcatname').val() && $('#cat_id').val()){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ajax_sub_cat_add',
                method: 'POST', 
                data: { _token: CSRF_TOKEN, message: $('#cat_id').val(), name: $('#subcatname').val()},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    swal(
                        'Added!',
                        'Subcategory has been Added.',
                        'success'
                    );
                    setTimeout( function() {
                        location.reload(true);
                    }, 1000);
                }
            });
        }
    });

    $('.edit_sub_cat').on("click", function(){
        var subcat_id = $(this).parent().parent().find('.subcat').children(":selected").attr('id');
        var subcat_name = $(this).parent().parent().find('.subcat').children(":selected").text();
        if(subcat_id) {
            $('#edit_subcat_id').val(subcat_id);
            $('#sub_cat_edit_modal').modal();
            $('#subcateditname').val(subcat_name);
        }
    });

    $('.edit_sub_cat_perfom').on('click', function(){
        $('#sub_cat_edit_modal').modal('toggle');
        if($('#subcateditname').val() && $('#edit_subcat_id').val()){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ajax_sub_cat_update',
                method: 'POST', 
                data: { _token: CSRF_TOKEN, id: $('#edit_subcat_id').val(), name: $('#subcateditname').val()},
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    swal(
                        'Updated!',
                        'Subcategory has been Updated.',
                        'success'
                    );
                    setTimeout( function() {
                        location.reload(true);
                    }, 1000);
                }
            });
        }
    });
</script>
@endsection