<div class="table">
    <div class="form-group">
        {!! Form::label('category1', 'Engineer Category', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category1', $categories1, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category2', 'Group part or equipment', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category2', $categories2, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category3', 'Engineering Application', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category3', $categories3, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category4', 'Group description of part & equipment', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category4', $categories4, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category5', 'Detail description of part & equipment', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category5', $categories5, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category6', 'Part & Equipment Brand Name', ['class' => 'col-md-4 col-sm-4 col-xs-12 col-12 control-label']) !!}
        <div class="col-sm-6 col-xs-12 col-12">
            {!! Form::select('category6', $categories6, null, ['class' => 'form-control subcat']) !!}
        </div>
    </div>
</div>