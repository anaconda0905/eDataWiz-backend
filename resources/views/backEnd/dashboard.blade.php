@extends('backLayout.app')
@section('title')
Dashboard
@stop

@section('style')

@stop
@section('content')

<div class="row">
  <div class="col-12">
    <h2 class="mt-4">File management</h2>
    <iframe src="/filemanager" style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
  </div>
</div>

@endsection

@section('scripts')


@endsection