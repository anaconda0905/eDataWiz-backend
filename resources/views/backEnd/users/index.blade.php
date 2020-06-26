@extends('backLayout.app')
@section('title')
Users
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Users</div>

    <div class="panel-body" style="overflow: scroll;">
        @if (Sentinel::getUser()->hasAccess(['user.create']))
        <a href="{{route('user.create')}}" class="btn btn-success">New User</a>
        @endif
        <table class="table table-bordered table-striped table-hover" id="tblUsers">
            <thead>
                <tr>
                    <th style="width: 10%">Select All <input name="select_all" value="1" id="example-select-all" type="checkbox" /></th>
                    <th style="width: 3%">ID</th>
                    <th style="width: 10%">First name</th>
                    <th style="width: 10%">Last name</th>
                    <th style="width: 10%">E-mail</th>
                    <th style="width: 5%">Company</th>
                    <th style="width: 5%">Phone</th>
                    <th style="width: 10%">user Role</th>
                    <th style="width: 17%">Created At</th>
                    <th style="width: 30%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ Form::checkbox('sel', $user->id, null, ['class' => ''])}}</td>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user.show', $user->id)}}">{{$user->first_name}}</a></td>
                    <td><a href="{{route('user.show', $user->id)}}">{{$user->last_name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->company}}</td>
                    <td>{{$user->phone}}</td>
                    @if(empty($user->roles()->first()))
                    <td>
                        <a href="{{route('user.index',['type='])}}">{{empty($user->roles()->first())?"":$user->roles()->first()->name}}</a>
                    </td>
                    @else
                    <td> <a
                            href="{{route('user.index',['type='.$user->roles()->first()->name])}}">{{empty($user->roles()->first())?"":$user->roles()->first()->name}}</a>
                    </td>
                    @endif
                    <td>{{$user->created_at}}</td>
                    <td>
                        @if (Sentinel::getUser()->hasAccess(['user.show']))
                            <a href="{{route('user.show', $user->id)}}" class="btn btn-primary btn-xs">View</a>
                        @endif
                        @if (Sentinel::getUser()->hasAccess(['user.edit']))
                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-xs">edit</a>
                        @endif
                        @if (Sentinel::getUser()->hasAccess(['user.permissions']))
                            <a href="{{route('user.permissions', $user->id)}}" 
                                class="btn btn-warning btn-xs">Permissions</a>
                        @endif
                        
                        @if(sizeof($user->activations) == 0)
                            @if (Sentinel::getUser()->hasAccess(['user.activate']))
                                <a href="{{route('user.activate', $user->id)}}" class="btn btn-primary btn-xs">Activate</a>
                            @endif
                        @else
                            @if (Sentinel::getUser()->hasAccess(['user.deactivate']))
                            <a href="{{route('user.deactivate', $user->id)}}" class="btn btn-warning btn-xs">Deactivate</a>
                            @endif
                        @endif

                        @if (Sentinel::getUser()->hasAccess(['user.destroy']))
                        {!! Form::open(['method'=>'DELETE', 'route' => ['user.destroy', $user->id], 'style' =>
                        'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
                        {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br/><br/>
        @if (Sentinel::getUser()->hasAccess(['user.destroy']))
        <button id="delete_all" class='btn btn-danger btn-xs'>Delete Selected</button>
        @endif
        @if (Sentinel::getUser()->hasAccess(['user.activate']))
        <button id="activate_all" class='btn btn-primary btn-xs'>Activate Selected</button>
        @endif
        @if (Sentinel::getUser()->hasAccess(['user.deactivate']))
        <button id="deactivate_all" class='btn btn-warning btn-xs'>Deactivate Selected</button>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        table = $('#tblUsers').DataTable({
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
            }],
            'order': [1, 'asc']
        });
    });
    // Handle click on "Select all" control
    $('#example-select-all').on('click', function () {
        // Check/uncheck all checkboxes in the table
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    $("input#delete-confirm").on("click", function () {
        return confirm("Are you sure to delete this user");
    });
    // start Delete All function
    $("#delete_all").click(function (event) {
        event.preventDefault();
        if (confirm("Are you sure to Delete Selected?")) {
            var value = get_Selected_id();
            if (value != '') {

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{action('UserController@ajax_all')}}",
                    data: { all_id: value, action: 'delete' },
                    success: function (data) {
                        location.reload()
                    }
                })

            } else { return confirm("You have to select any item before"); }
        }
        return false;
    });
    //End Delete All Function
    //Start Deactivate all Function
    $("#deactivate_all").click(function (event) {
        event.preventDefault();
        if (confirm("Are you sure to Deactivate Selected ?")) {
            var value = get_Selected_id();
            if (value != '') {

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{action('UserController@ajax_all')}}",
                    data: { all_id: value, action: 'deactivate' },
                    success: function (data) {
                        location.reload()
                    }
                })

            } else { return confirm("You have to select any item before"); }
        }
        return false;
    });
    //End Deactivate Function
    //Start Activate all Function
    $("#activate_all").click(function (event) {
        event.preventDefault();
        if (confirm("Are you sure to Activate Selected ?")) {
            var value = get_Selected_id();
            if (value != '') {

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{action('UserController@ajax_all')}}",
                    data: { all_id: value, action: 'activate' },
                    success: function (data) {
                        location.reload()
                    }
                })

            } else { return confirm("You have to select any checkbox before"); }
        }
        return false;
    });
    //End Activate Function

    function get_Selected_id() {
        var searchIDs = $("input[name=sel]:checked").map(function () {
            return $(this).val();
        }).get();
        return searchIDs;
    }
</script>
@endsection