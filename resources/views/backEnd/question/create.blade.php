@extends('question.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add Product</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('questions.index') }}"> Back</a>
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
        @csrf
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
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Parts & equipments:</strong><br>
                    <select class="form-control" id="classification-select" name="classification" style="width:100%; height: 40px;" required>
                        @foreach ($classifications as $classification)
                           <option value="{{$classification->id}}" data-id="{{$classification->id}}">{{$classification->pd_classification}}</option>
                        @endforeach
                    </select>
                </div>
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
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name of Part & Equipment:</strong><br>
                    <select class="form-control" id="list-select" name="list" style="width:100%; height: 40px;" required>
                        @foreach ($pdLists as $list)
                           <option value="{{$list->id}}" data-id="{{$list->id}}">{{$list->pd_list}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Brand Name of the Part & Equipment:</strong><br>
                    <select class="form-control" id="brand-select" name="brand" style="width:100%; height: 40px;" required>
                        @foreach ($brands as $brand)
                           <option value="{{$brand->pd_brand}}" data-id="{{$brand->id}}">{{$brand->pd_brand}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>File:</strong>
                <div class="form-group"> 
                    <input class="form-control" type="file" name="file" accept=".pdf" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
            <button  type="submit" class="btn btn-primary" id="question-submit">
                <span class="spinner-border spinner-border-sm" id="submit-spinner"></span>
                Submit
            </button>
            </div>
        </div>
    </form>

@endsection
@section('script')
<script>
    var generals =  @json($generals);
    var classifications =  @json($classifications);
    var headers =  @json($headers);
    var pdLists =  @json($pdLists);
    var brands =  @json($brands);
    $("#submit-spinner").hide();
    $("#question-form").on("submit",function(e){
        //e.preventDefault();
        $("#submit-spinner").show();
    });
</script>
<script src="{{asset('js/pagejs/question.js')}}"></script>
@endsection