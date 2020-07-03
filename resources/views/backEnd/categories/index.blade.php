
@extends('backLayout.app')
@section('title')
Categories
@stop

@section('content')

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center">
                Categories
            </h2>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Engineer Category</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                <td>
                    <select id="general-select" style="width:100%; height: 40px;">
                    @foreach ($generals as $general)
                    <option value="{{$general->pd_general}}" data-id="{{$general->id}}">{{$general->pd_general}}</option>
                    @endforeach
                </select>
                </td>
                <td>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#add-general-modal">Add</button>
                    <a class="btn btn-primary" href="javascript:void(0)" id="edit-general-btn">Edit</a>
                    <a class="btn btn-danger" href="javascript:void(0)" id="delete-general-btn">Delete</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Group Parts & Equipement</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                    <td>
                        <select id="classification-select"  style="width:100%; height: 40px;">
                        @foreach ($classifications as $classification)
                           <option value="{{$classification->pd_classification}}" data-id="{{$classification->id}}">{{$classification->pd_classification}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                         <a class="btn btn-success " href="javascript:void(0)" id="add-classification-btn">Add</a>
                         <a class="btn btn-primary" href="javascript:void(0)" id="edit-classification-btn">Edit</a>
                         <a class="btn btn-danger" href="javascript:void(0)" id="delete-classification-btn">Delete</a>
                    </td>
                </tr>
        </table>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Engineering Application</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                    <td>
                        <select id="header-select" style="width:100%; height: 40px;">
                        @foreach ($headers as $header)
                           <option value="{{$header->pd_header}}" data-id="{{$header->id}}">{{$header->pd_header}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                         <a class="btn btn-success" href="javascript:void(0)" id="add-header-btn">Add</a>
                         <a class="btn btn-primary" href="javascript:void(0)" id="edit-header-btn">Edit</a>
                         <a class="btn btn-danger" href="javascript:void(0)" id="delete-header-btn">Delete</a>
                    </td>
                </tr>
        </table>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Group Description of Part & Equipment</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                    <td>
                        <select id="list-select" style="width:100%; height: 40px;">
                        @foreach ($pdLists as $pdList)
                           <option value="{{$pdList->pd_list}}" data-id="{{$pdList->id}}">{{$pdList->pd_list}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                         <a class="btn btn-success" href="javascript:void(0)" id="add-list-btn">Add</a>
                         <a class="btn btn-primary" href="javascript:void(0)" id="edit-list-btn">Edit</a>
                         <a class="btn btn-danger" href="javascript:void(0)" id="delete-list-btn">Delete</a>
                    </td>
                </tr>
        </table>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Detail Description of Part & Equipment</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                    <td>
                        <select id="dlist-select" style="width:100%; height: 40px;">
                        @foreach ($dpdLists as $dpdList)
                           <option value="{{$dpdList->dpd_list}}" data-id="{{$dpdList->id}}">{{$dpdList->dpd_list}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                         <a class="btn btn-success" href="javascript:void(0)" id="add-dlist-btn">Add</a>
                         <a class="btn btn-primary" href="javascript:void(0)" id="edit-dlist-btn">Edit</a>
                         <a class="btn btn-danger" href="javascript:void(0)" id="delete-dlist-btn">Delete</a>
                    </td>
                </tr>
        </table>
    </div>
    <div class="table-responsive"> 
        <table class="table table-bordered">
            <tr>
                <th>Brand Name of the Part & Equipment</th>
                <th width="280px">More</th>
            </tr>
            <tr>
                    <td>
                        <select id="brand-select" style="width:100%; height: 40px;">
                        @foreach ($brands as $brand)
                           <option value="{{$brand->pd_brand}}" data-id="{{$brand->id}}">{{$brand->pd_brand}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                         <a class="btn btn-success" href="javascript:void(0)" id="add-brand-btn">Add</a>
                         <a class="btn btn-primary" href="javascript:void(0)" id="edit-brand-btn">Edit</a>
                         <a class="btn btn-danger" href="javascript:void(0)" id="delete-brand-btn">Delete</a>
                    </td>
                </tr>
        </table>
    </div>

    <div class="modal fade" id="add-general-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Engineer Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="add-general-name">Engineer Category:</label>
                                <input type="text" class="form-control" id="add-general-name" name="general">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="add-general-submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-general-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Engineer Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-general-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-general-name">Engineer Category:</label>
                                <input type="text" class="form-control" id="edit-general-name" name="general">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-general-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-general-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Engineer Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-general-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-general-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-classification-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Parts & Equipement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="add-classification-general-id" name="general">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="add-classification-name">Parts & Equipement:</label>
                                <input type="text" class="form-control" name="classification" id="add-classification-name">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-classification-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-classification-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Parts & Equipement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-classification-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-classification-name">Parts & Equipement:</label>
                                <input type="text" class="form-control" id="edit-classification-name" name="classification">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-classification-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-classification-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Parts & Equipement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-classification-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-classification-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-header-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Engineer Application</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="add-header-classification-id" name="classification">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add-header-name">Engineer Application:</label>
                            <input type="text" class="form-control" id="add-header-name" name="header">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-header-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-header-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Engineer Application</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-header-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-header-name">Engineer Application:</label>
                                <input type="text" class="form-control" id="edit-header-name" name="header">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-header-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-header-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Engineer Application</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-header-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-header-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-list-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Group Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="add-list-header-id" name="header">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add-list-name">Group Description of Part & Equipment:</label>
                            <input type="text" class="form-control" id="add-list-name" name="list">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-list-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-list-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Group Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-list-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-list-name">Group Description of Part & Equipment:</label>
                                <input type="text" class="form-control" id="edit-list-name" name="list">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-list-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-list-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Group Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-list-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-list-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-dlist-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Detail Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="add-dlist-header-id" name="header">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add-dlist-name">Detail Description of Part & Equipment:</label>
                            <input type="text" class="form-control" id="add-dlist-name" name="dlist">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-dlist-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-dlist-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Detail Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-dlist-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-dlist-name">Detail Description of Part & Equipment:</label>
                                <input type="text" class="form-control" id="edit-dlist-name" name="dlist">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-dlist-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-dlist-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Detail Description of Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-dlist-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-dlist-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-brand-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Brand Name of the Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="add-brand-list-id" name="list">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add-brand-name">Brand Name of the Part & Equipment:</label>
                            <input type="text" class="form-control" id="add-brand-name" name="brand">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add-brand-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-brand-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Brand Name of the Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="edit-brand-id" name="id">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-brand-name">Brand Name of the Part & Equipment:</label>
                                <input type="text" class="form-control" id="edit-brand-name" name="brand">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="edit-brand-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-brand-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Brand Name of the Part & Equipment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Do you really want to delete items?
                </div>
                <form  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" id="delete-brand-id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-brand-submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="parent-confirm-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="message"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var generals =  {!! $generals !!};
    var classifications =  {!! $classifications !!};
    var headers =  {!! $headers !!};
    var pdLists =  {!! $pdLists !!};
    var dpdLists =  {!! $dpdLists !!};
    var brands =  {!! $brands !!};
    
    $(document).keypress(
      function(event){
        if (event.which == '13') {
          event.preventDefault();
        }
});
</script>
<script src="{{ URL::asset('/js/category.js') }}"></script>
@endsection