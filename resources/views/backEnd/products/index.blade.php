@extends('backLayout.app')
@section('title')
All Products
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">All Products</div>
    <div class="panel-body" style="overflow: scroll;">
        <a href="{{ url('product/create') }}" class="btn btn-success">New Product</a>
        <div class="table">
            <table class="table table-bordered table-striped table-hover" id="tblroles">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Engineer Category</th>
                        <th>Group part or equipment</th>
                        <th>Engineering Application</th>
                        <th>Group description of part & equipment</th>
                        <th>Detail description of part & equipment</th>
                        <th>Part & Equipment Brand Name</th>
                        <th>File Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td>
                            @foreach ($category1 as $item)
                                @if ($item->id == $product->category1_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category2 as $item)
                                @if ($item->id == $product->category2_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category3 as $item)
                                @if ($item->id == $product->category3_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category4 as $item)
                                @if ($item->id == $product->category4_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category5 as $item)
                                @if ($item->id == $product->category5_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($category5 as $item)
                                @if ($item->id == $product->category6_id)
                                    {{ $item->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $product->filename }}
                        </td>
                        
                        <td>
                            @foreach ($users as $item)
                                @if ($item->id = $product->user_id)
                                    <a class="btn btn-primary btn-xs edit_product">Edit</a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['product', $product->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                                    {!! Form::close() !!}
                                @endif
                            @endforeach
                            <a class="btn btn-primary btn-xs detail_product">Property</a>
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
        return confirm("Are you sure to delete this Role");
    });

    
</script>
@endsection