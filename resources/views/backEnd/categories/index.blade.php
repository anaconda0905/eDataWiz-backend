@extends('backLayout.app')
@section('title')
Categories
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        @include('backEnd.categories.table')
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
          <input type="hidden" id="edit_cat_id" value=""/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary edit_sub_cat_perfom">Update</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    $('.table').on("change", "select[name=category1]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update1',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat1 : cat1,
            },
            success: function (data) {
                $('.table').html(data.html);
                $('select[name=category1]').val(cat1);
            }
        });
    });

    $('.table').on("change", "select[name=category2]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update2',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat1 : cat1,
                cat2 : cat2,
            },
            success: function (data) {
                $('.table').html(data.html);
                $('select[name=category1]').val(cat1);
                $('select[name=category2]').val(cat2);
            }
        });
    });

    $('.table').on("change", "select[name=category3]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update3',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat1 : cat1,
                cat2 : cat2,
                cat3 : cat3,
            },
            success: function (data) {
                $('.table').html(data.html);
                $('select[name=category1]').val(cat1);
                $('select[name=category2]').val(cat2);
                $('select[name=category3]').val(cat3);
            }
        });
    });

    $('.table').on("change", "select[name=category4]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update4',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat1 : cat1,
                cat2 : cat2,
                cat3 : cat3,
                cat4 : cat4,
            },
            success: function (data) {
                $('.table').html(data.html);
                $('select[name=category1]').val(cat1);
                $('select[name=category2]').val(cat2);
                $('select[name=category3]').val(cat3);
                $('select[name=category4]').val(cat4);
            }
        });
    });

    $('.table').on("change", "select[name=category5]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update5',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                cat1 : cat1,
                cat2 : cat2,
                cat3 : cat3,
                cat4 : cat4,
                cat5 : cat5,
            },
            success: function (data) {
                $('.table').html(data.html);
                $('select[name=category1]').val(cat1);
                $('select[name=category2]').val(cat2);
                $('select[name=category3]').val(cat3);
                $('select[name=category4]').val(cat4);
                $('select[name=category5]').val(cat5);
            }
        });
    });

    $('.table').on("click", ".delete_cat", function(){
        var subcat_id = $(this).parent().parent().find('.subcat').children(":selected").val();
        var cat_id = $(this).parent().attr("cat_id");
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
                    data: { _token: CSRF_TOKEN, cat_id: cat_id, subcat_id: subcat_id },
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

    
    $('.table').on("click", ".add_sub_cat", function(){
        var cat_id = $(this).parent().attr("cat_id");
        if(cat_id) {
            $('#sub_cat_add_modal').modal();
            $('#cat_id').val(cat_id);
        }
    });

    $('.add_sub_cat_perfom').on('click', function(){
        $('#sub_cat_add_modal').modal('toggle');
        var subcat_ids = [];
        $('.subcat').each(function(){
            subcat_ids.push($(this).val());
        });
        var cat_id = $('#cat_id').val();
        var parent_id;
        if(cat_id == 1) parent_id = 1;
        else parent_id = subcat_ids[cat_id-2];

        if($('#subcatname').val() && parent_id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ajax_sub_cat_add',
                method: 'POST', 
                data: { _token: CSRF_TOKEN, parent_id: parent_id, name: $('#subcatname').val(), cat_id:cat_id},
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

    $('.table').on("click", ".edit_sub_cat", function(){
        var cat_id = $(this).parent().attr("cat_id");
        var subcat_id = $(this).parent().parent().find('.subcat').children(":selected").val();
        var subcat_name = $(this).parent().parent().find('.subcat').children(":selected").text();
        if(subcat_id) {
            $('#edit_subcat_id').val(subcat_id);
            $('#edit_cat_id').val(cat_id);
            $('#subcateditname').val(subcat_name);
            $('#sub_cat_edit_modal').modal();
        }
    });

    $('.edit_sub_cat_perfom').on('click', function(){
        $('#sub_cat_edit_modal').modal('toggle');
        if($('#subcateditname').val() && $('#edit_subcat_id').val()){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ajax_sub_cat_update',
                method: 'POST', 
                data: { _token: CSRF_TOKEN, cat_id:$('#edit_cat_id').val(), subcat_id: $('#edit_subcat_id').val(), subcat_name: $('#subcateditname').val()},
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