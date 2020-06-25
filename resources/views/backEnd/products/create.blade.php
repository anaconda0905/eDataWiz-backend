@extends('backLayout.app')
@section('title')
New Product
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">New Product</div>

    <div class="panel-body">
        {!! Form::open(['url' => 'product', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'method' => 'post', 'files' => true, 'id' => "productForm"]) !!}
        @foreach($categories as $item)
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
            <div class="form-group">
                {!! Form::label('category', $item->name, ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
                <div class="col-sm-6 col-xs-12 col-12">
                    {!! Form::select($item->id, $current_subcategories, null, ['class' => 'form-control subcat'], $current_subcategories_id) !!}
                </div>
            </div>
        @endforeach
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
            var selected_id = $(this).children(":selected").attr('id');
            if(typeof selected_id == "undefined")
                selected_id = '0';
            items[$(this).attr('name')] = selected_id;
        });
        $('#categories').val(JSON.stringify(items));
        $('#productForm').submit();
    });
</script>
@endsection