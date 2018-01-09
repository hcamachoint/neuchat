@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>
				Briefcases
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
		              <i class="glyphicon glyphicon-plus-sign"> Add</i>
		            </button>
		            <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!!Form::open(['route'=>['briefcase-store', $user->id], 'method' => 'post'])!!}
                            	{{ csrf_field() }}
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title" id="myModalLabel">New Briefcases info</h3>
                                </div>
                                <div class="modal-body">
                                    @include('briefcases.forms.add')<br>
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
		@if (count($user->briefcase) === 0)
			<p>There is no data associated!</p>
		@else
			@foreach($user->briefcase as $bri)
				{!!Form::open(['route'=>['briefcase-update', $bri->id],'method' => 'put'])!!}
					{{ csrf_field() }}
					@include('briefcases.forms.edit')
				{!!Form::close()!!}
				{!!Form::open(['route'=>['briefcase-destroy', $bri->id], 'method' => 'delete'])!!}
					{{ csrf_field() }}
					@include('briefcases.forms.del')
				{!!Form::close()!!}
				<br>
			@endforeach
		@endif
		<br>
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a><br><br>
</div>

@endsection