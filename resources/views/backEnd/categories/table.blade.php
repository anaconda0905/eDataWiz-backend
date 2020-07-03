<div class="panel searchtable">
    <div class="panel-body">
        @if(sizeof($questions) > 0)
        <div class="table-responsive"> 
            <table class="table table-striped table-bordered" id="question-table">
                <thead>  
                <tr>
                    <th>No</th>
                    <th>Engineer Category</th>
                    <th>Group part or equipment</th>
                    <th>Engineering Application</th>
                    <th>Group description of part & equipment</th>
                    <th>Detail description of part & equipment</th>
                    <th>Part & Equipment Brand Name</th>
                    <th>File Name</th>
                    <th>More</th>
                </tr>
                </thead>  
                @foreach ($questions as $k => $question)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $question->general->pd_general }}</td>
                        <td>{{ $question->classification->pd_classification}}</td>
                        <td>{{ $question->header->pd_header }}</td>

                        @if ($question->pdList)
                            <td>{{ $question->pdList->pd_list }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        
                        @if ($question->dpdList)
                            <td>{{ $question->dpdList->dpd_list }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        
                        @if ($question->brand)
                            <td>{{ $question->brand->pd_brand }}</td>    
                        @else
                            <td>Null</td>
                        @endif
                        <td>{{ $question->filename }}</td>                    
                        
                        <td>
                            <a class="btn btn-success btn-xs btn-block detail_product" path="{{ $question->filepath }}" filename="{{ $question->filename }}">Property</a>
                            @if (Sentinel::getUser()->hasAnyAccess(['questions.create']))
                            <a class="btn btn-xs btn-block btn-primary" href="{{ route('questions.edit',$question->id) }}">Edit</a>
                            <button  class="btn btn-xs btn-block btn-danger delete-question-btn"  data-id="{{$question->id}}">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        @else
            <div class="alert alert-alert">Nothing to display. Search Product!</div>
        @endif
    </div>
</div>