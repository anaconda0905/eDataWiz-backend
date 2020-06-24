@extends('backLayout.app')
@section('title')
Category
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Category</div>
    <div class="panel-body">
        <a href="{{ url('category/create') }}" class="btn btn-success">New Category</a>
        <div class="table">
            <table class="table table-bordered table-striped table-hover" id="tblroles">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subcategory</th>
                        <th>Subcategory Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $item)

                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('category', $item->id) }}">{{ $item->name }}</a></td>
                        <td>
                            {!! Form::select('role', $item, null, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            <a href="{{route('user.index',['type='.$item->name])}}" class="btn btn-primary btn-xs">Add</a>
                            <a href="{{ url('category/' . $item->id . '/edit') }}"
                                class="btn btn-success btn-xs">Edit</a>
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['category', $item->id],
                            'style' => 'display:inline'
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a href="{{route('user.index',['type='.$item->name])}}" class="btn btn-primary btn-xs">View
                                Products</a>
                            <a href="{{ url('category/' . $item->id . '/edit') }}"
                                class="btn btn-success btn-xs">Edit</a>
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['category', $item->id],
                            'style' => 'display:inline'
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tblroles').DataTable({
            columnDefs: [{
                targets: [0],
                // visible: false,
                searchable: false
            },
            ],
            order: [[0, "asc"]],
        });
    });
    $(".deleteconfirm").on("click", function () {
        return confirm("Are you sure to delete this Category");
    });
</script>
@endsection