
@extends('backLayout.app')
@section('title')
Categories
@stop

@section('content')

    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">
                            Categories
                        </h2>
                    </div>
                </div>
                <div class="panel panel-product">
                    <div class="panel-body">
                        <a class="btn btn-block btn-info searchProduct">Search Product</a>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">
                                        Engineer Category
                                    </th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="general-select" style="width:100%; height: 40px;">
                                            @foreach ($generals as $general)
                                            <option value="{{$general->pd_general}}" data-id="{{$general->id}}">{{$general->pd_general}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#add-general-modal">Add</button>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-general-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-general-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">Group Parts & Equipement</th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="classification-select"  style="width:100%; height: 40px;">
                                            @foreach ($classifications as $classification)
                                            <option value="{{$classification->pd_classification}}" data-id="{{$classification->id}}">{{$classification->pd_classification}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <a class="btn btn-success " href="javascript:void(0)" id="add-classification-btn">Add</a>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-classification-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-classification-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">Engineering Application</th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="header-select" style="width:100%; height: 40px;">
                                            @foreach ($headers as $header)
                                            <option value="{{$header->pd_header}}" data-id="{{$header->id}}">{{$header->pd_header}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <a class="btn btn-success" href="javascript:void(0)" id="add-header-btn">Add</a>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-header-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-header-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">Group Description of Part & Equipment</th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="list-select" style="width:100%; height: 40px;">
                                            @foreach ($pdLists as $pdList)
                                            <option value="{{$pdList->pd_list}}" data-id="{{$pdList->id}}">{{$pdList->pd_list}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <a class="btn btn-success" href="javascript:void(0)" id="add-list-btn">Add</a>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-list-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-list-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">Detail Description of Part & Equipment</th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="dlist-select" style="width:100%; height: 40px;">
                                            @foreach ($dpdLists as $dpdList)
                                            <option value="{{$dpdList->dpd_list}}" data-id="{{$dpdList->id}}">{{$dpdList->dpd_list}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <a class="btn btn-success" href="javascript:void(0)" id="add-dlist-btn">Add</a>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-dlist-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-dlist-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="table-responsive"> 
                            <table class="table table-bordered">
                                <tr>
                                    <th width="70%">Brand Name of the Part & Equipment</th>
                                </tr>
                                <tr>
                                    <td width="70%">
                                        <select id="brand-select" style="width:100%; height: 40px;">
                                            @foreach ($brands as $brand)
                                            <option value="{{$brand->pd_brand}}" data-id="{{$brand->id}}">{{$brand->pd_brand}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                                <tr>
                                    <td>
                                        <a class="btn btn-success" href="javascript:void(0)" id="add-brand-btn">Add</a>
                                        <a class="btn btn-primary" href="javascript:void(0)" id="edit-brand-btn">Edit</a>
                                        <a class="btn btn-danger" href="javascript:void(0)" id="delete-brand-btn">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center">Search Result</h2>
                    </div>
                </div>
                @include('backEnd.categories.table')
            </div>
        </div>
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
            
            <form action="/deleteQuestion" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="delete-question-id" name="id">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Properties</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center qrcode">
            <img id="qrcodeimage" style="-webkit-user-drag: none; border: 1px solid lightgray;" src=""><br/>
            <input type="hidden" id="img_size" value="200"/>
            <input type="hidden" id="qrcodeimage_url" value="200"/>
            <strong><a id="img_size_minus"><i class="fa fa-search-minus"></i></a>&nbsp;&nbsp;<b id="img_dimension">200*200</b>&nbsp;&nbsp;<a id="img_size_plus"><i class="fa fa-search-plus"></i></a></strong>  
            <br/><br/>
            <strong id="file_name" style="display:none; word-break: break-word;padding: 10px;"></strong>
            <a id="qrcodeimage_download" class="btn btn-success" download="frame.png" href=""><i class="fa fa-download"></i>&nbsp;Download QRcode</a>
          </div>
        </div>
        <div class="modal-footer">
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

    $(".searchtable").on("click", ".delete-question-btn", function(){
        var id = $(this).data("id");
        $("#delete-question-id").val(id);
        $('#delete-question-modal').modal('toggle');
    });
    
    $('.searchProduct').on("click", function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var c1_id = $("#general-select").children("option:selected").data("id");
        var c2_id = $("#classification-select").children("option:selected").data("id");
        var c3_id = $("#header-select").children("option:selected").data("id");
        var c4_id = $("#list-select").children("option:selected").data("id");
        var c5_id = $("#dlist-select").children("option:selected").data("id");
        var c6_id = $("#brand-select").children("option:selected").data("id");
        
        $.ajax({
            url: '/searchProduct',
            method: 'POST',
            data: { 
                _token: CSRF_TOKEN, 
                pd_general:c1_id,
                pd_classification:c2_id,
                pd_header:c3_id,
                pd_list:c4_id,
                dpd_list:c5_id,
                pd_brand:c6_id, 
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (response) {
                $('.searchtable').html(response.html);
                $('#question-table').DataTable();
            }
        });
    });

    $('.searchtable').on("click", ".detail_product", function(){
        $('#exampleModalCenter').modal();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var absolute_path = $(this).attr('path');
        var file_name = $(this).attr('filename');
        $.ajax({
            url: '/ajax_update',
            method: 'POST',
            data: { _token: CSRF_TOKEN, message: absolute_path, dimension:200, filename:file_name },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                $('#qrcodeimage').attr("src", data.msg);
                $('#qrcodeimage_url').val(absolute_path);
                $('#img_dimension').text("200*200");
                $('#file_name').text(file_name);
                $('#qrcodeimage_download').attr("href", data.msg);
            }
        });
    });
    
    $('#img_size_minus').on('click', function(){
      var size = parseInt($('#img_size').val()) - 50;
      if(size > 149 && size < 251){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size, filename:$('#file_name').text() },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            $('#qrcodeimage').attr("src", data.msg);
            $('#qrcodeimage_download').css("display", "block");
            $('#qrcodeimage_download').attr("href", data.msg);
          }
        });
        $('#img_size').val(size);
        $('#img_dimension').text(size + "*" +size);
      }
    });
    $('#img_size_plus').on('click', function(){
      var size1 = parseInt($('#img_size').val()) + 50;
      if(size1 > 149 && size1 < 251){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: '/ajax_update',
          method: 'POST',
          data: { _token: CSRF_TOKEN, message: $('#qrcodeimage_url').val(), dimension:size1 },
          dataType: 'JSON',
          /* remind that 'data' is the response of the AjaxController */
          success: function (data) {
            $('#qrcodeimage').attr("src", data.msg);
            $('#qrcodeimage_download').css("display", "block");
            $('#qrcodeimage_download').attr("href", data.msg);
          }
        });
        $('#img_size').val(size1);
        $('#img_dimension').text(size1 + "*" +size1);
      }
    });
</script>
<script src="{{ URL::asset('/js/category.js') }}"></script>
@endsection