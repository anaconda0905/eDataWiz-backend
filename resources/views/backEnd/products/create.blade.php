@extends('backLayout.app')
@section('title')
New Product
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">New Product</div>
    <div class="panel-body">
        {!! Form::open(['url' => route('product.store'), 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'method' => 'post', 'files' => true, 'id' => "productForm"]) !!}
        @include('backEnd.products.table')
        <div class="form-group {{ $errors->has('fileselect') ? 'has-error' : ''}}">
            {!! Form::label('fileselect', 'Upload File', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
            <div class="col-sm-6 col-xs-12 col-12">
                <div class="form-group desktop-upload">
                    <div>
                        <div id="filedrag">
                            <img class="box-icon" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Octicons-cloud-upload.svg" />
                            <label for="fileselect">Drop files here or</label>
                            <input type="file" id="fileselect" name="fileselect" accept=".pdf"/>
                        </div>
                    </div>
                </div>
                {!! $errors->first('fileselect', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <input type="hidden" name="categories" id="categories" value="" />
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
                <a id="productFormSubmit" class="btn btn-success form-control">Submit</a>
            </div>
            <a href="{{route('product.index')}}" class="btn btn-default">Return to all products</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#productFormSubmit').on('click', function(){ 
        var items = {};
        $('.subcat').each(function(){
            var selected_id = $(this).val();
            items[$(this).attr('name')] = selected_id;
        });
        $('#categories').val(JSON.stringify(items));
        $('#productForm').submit();
    });

    $('.table').on("change", "select[name=category1]", function(){
        var cat1 = $('select[name=category1]').val();
        var cat2 = $('select[name=category2]').val();
        var cat3 = $('select[name=category3]').val();
        var cat4 = $('select[name=category4]').val();
        var cat5 = $('select[name=category5]').val();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/ajax_catgories_update11',
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
            url: '/ajax_catgories_update12',
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
            url: '/ajax_catgories_update13',
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
            url: '/ajax_catgories_update14',
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
            url: '/ajax_catgories_update15',
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
</script>
@endsection