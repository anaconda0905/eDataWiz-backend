<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Engineer Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category1', $categories1, null, ['class' => 'form-control subcat']) !!}
                </td>
                
                <td cat_id="1">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Group part or equipment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category2', $categories2, null, ['class' => 'form-control subcat']) !!}
                </td>
                <td cat_id="2">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Engineering Application</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category3', $categories3, null, ['class' => 'form-control subcat']) !!}
                </td>
                
                <td cat_id="3">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Group description of part & equipment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category4', $categories4, null, ['class' => 'form-control subcat']) !!}
                </td>
                
                <td cat_id="4">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat ">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Detail description of part & equipment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category5', $categories5, null, ['class' => 'form-control subcat']) !!}
                </td>
                
                <td cat_id="5">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="70%">Part & Equipment Brand Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {!! Form::select('category6', $categories6, null, ['class' => 'form-control subcat']) !!}
                </td>
                
                <td cat_id="6">
                    <a class="btn btn-success btn-xs add_sub_cat">Add</a>
                    <a class="btn btn-primary btn-xs edit_sub_cat">Edit</a>
                    <a class="btn btn-danger btn-xs delete_cat">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>