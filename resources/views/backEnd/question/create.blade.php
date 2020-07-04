@extends('backLayout.app')
@section('title')
New Product
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add Product</h2>
        </div>
    </div>

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

    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data" id="question-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Engineer Category:</strong><br>
                    <select class="form-control" id="general-select" name="general" style="width:100%; height: 40px;" required>
                        @foreach ($generals as $general)
                           <option value="{{$general->id}}" data-id="{{$general->id}}">{{$general->pd_general}}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('general', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Group Parts & Equipement:</strong><br>
                    <select class="form-control" id="classification-select" name="classification" style="width:100%; height: 40px;" required>
                        @foreach ($classifications as $classification)
                           <option value="{{$classification->id}}" data-id="{{$classification->id}}">{{$classification->pd_classification}}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('classification', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Engineer Application:</strong><br>
                    <select class="form-control" id="header-select" name="header" style="width:100%; height: 40px;" required>
                        @foreach ($headers as $header)
                           <option value="{{$header->id}}" data-id="{{$header->id}}">{{$header->pd_header}}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('header', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Group Description of Part & Equipment:</strong><br>
                    <select class="form-control" id="list-select" name="list" style="width:100%; height: 40px;">
                        @foreach ($pdLists as $list)
                           <option value="{{$list->id}}" data-id="{{$list->id}}">{{$list->pd_list}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail Description of Part & Equipment:</strong><br>
                    <select class="form-control" id="dlist-select" name="dlist" style="width:100%; height: 40px;">
                        @foreach ($dpdLists as $dlist)
                           <option value="{{$dlist->id}}" data-id="{{$dlist->id}}">{{$dlist->dpd_list}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Brand Name of the Part & Equipment:</strong><br>
                    <select class="form-control" id="brand-select" name="brand" style="width:100%; height: 40px;">
                        @foreach ($brands as $brand)
                           <option value="{{$brand->id}}" data-id="{{$brand->id}}">{{$brand->pd_brand}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>File:</strong>
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

            <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
                <button  type="submit" class="btn btn-primary" id="question-submit">
                    <span class="spinner-border spinner-border-sm" id="submit-spinner"></span>
                    Submit
                </button>
                <a class="btn btn-success" href="{{ route('questions.index') }}"> Back</a>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
<script>
    var generals =  {!! $generals !!};
    var classifications =  {!! $classifications !!};
    var headers =  {!! $headers !!};
    var pdLists =  {!! $pdLists !!};
    var dpdLists =  {!! $dpdLists !!};
    var brands =  {!! $brands !!};
    $("#submit-spinner").hide();
    $("#question-form").on("submit",function(e){
        //e.preventDefault();
        $("#submit-spinner").show();
    });
</script>
<script src="{{ URL::asset('/js/question.js') }}"></script>
@endsection