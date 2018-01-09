@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>
				Socials
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
		              <i class="glyphicon glyphicon-plus-sign"> Add</i>
		            </button>
		            <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!!Form::open(['route'=>['social-store'], 'files' => true, 'method' => 'post'])!!}
                            	{{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title" id="myModalLabel">New Social info</h3>
                                </div>
                                <div class="modal-body">
                                    @include('socials.forms.add')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            {!!Form::close()!!}
                        </div>
                      </div>
                    </div>
			</h1>
		</div>
		@if (count($user->social) === 0)
			<p>There is no data associated!</p>
		@else
			@foreach($user->social as $soc)
			  {!!Form::open(['route'=>['social-update', $soc->id], 'files' => true, 'method' => 'put'])!!}
			  		{{ csrf_field() }}
					@include('socials.forms.edit')
				{!!Form::close()!!}
				{!!Form::open(['route'=>['social-destroy', $soc->id],'method' => 'delete'])!!}
					{{ csrf_field() }}
					@include('socials.forms.del')
				{!!Form::close()!!}
				<br>
			@endforeach
		@endif
		<br>
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a><br><br>
</div>

@endsection
