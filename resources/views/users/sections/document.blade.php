@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>
				Documents
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
		              <i class="glyphicon glyphicon-plus-sign"> Add</i>
		            </button>
		            <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!!Form::open(['route'=>['document-store', $user->id], 'files' => true, 'method' => 'post'])!!}
                            	{{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title" id="myModalLabel">New Document info</h3>
                                </div>
                                <div class="modal-body">
                                    @include('documents.forms.add')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            {!!Form::close()!!}
                        </div>
                      </div>
                    </div>
			</h1>
		</div>
		@if (count($user->document) === 0)
			<p>There is no data associated!</p>
		@else
			@foreach($user->document as $doc)
			  {!!Form::open(['route'=>['document-update', $doc->id], 'files' => true, 'method' => 'put'])!!}
			  		{{ csrf_field() }}
					@include('documents.forms.edit')
				{!!Form::close()!!}
				{!!Form::open(['route'=>['document-destroy', $doc->id],'method' => 'delete'])!!}
					{{ csrf_field() }}
					@include('documents.forms.del')
				{!!Form::close()!!}
				<br>
			@endforeach
		@endif
		<br>
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a><br><br>
</div>

@endsection
