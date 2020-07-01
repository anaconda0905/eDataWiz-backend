@extends('question.layout')

@section('content')

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center">
                Products
            </h2>
        </div>
        <div class="col-md-4 text-right pt-3">
            <a href="{{route('categories.index')}}">Categories</a>
            &nbsp; &nbsp;
            <a href="{{route('users.index')}}">Users</a>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('questions.create') }}"> Add Product</a>
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

    @if(sizeof($questions) > 0)
    <div class="table-responsive"> 
        <table class="table table-striped table-bordered" id="question-table">
            <thead>  
            <tr>
                <th>No</th>
                <th>Engineer Category</th>
                <th>Parts & equipments</th>
                <th>Engineer Application</th>
                <th>Name of Part & Equipment</th>
                <th>Brand Name of the Part & Equipment</th>
                <th>File Name</th>
                <th width="200px">More</th>
            </tr>
            </thead>  
            @foreach ($questions as $k => $question)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $question->general->pd_general }}</td>
                    <td>{{ $question->classification->pd_classification}}</td>
                    <td>{{ $question->header->pd_header }}</td>
                    <td>{{ $question->pdList->pd_list }}</td>
                    <td>{{ $question->brand->pd_brand }}</td>
                    <td>{{ $question->pd_filename }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('questions.edit',$question->id) }}">Edit</a>
                        <button  class="btn btn-danger delete-question-btn"  data-id="{{$question->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    @else
        <div class="alert alert-alert">Start Adding to the Database.</div>
    @endif


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
                <form action="{{route('deleteQuestion')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" id="delete-question-id" name="id">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script >
    $(document).ready(function() {
        $('#question-table').DataTable();
    } );
    $(".delete-question-btn").on("click",function(){
        var id = $(this).data("id");
        $("#delete-question-id").val(id);
        $('#delete-question-modal').modal('toggle');
    });
</script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
@endsection