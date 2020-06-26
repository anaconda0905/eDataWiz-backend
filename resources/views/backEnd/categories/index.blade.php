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
        var subcat_id = $(this).parent().parent().find('select').val();
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
</script>
@endsection