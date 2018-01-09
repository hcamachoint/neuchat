@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Location <small><a href="#"></a></small></h1>
		</div>
			@if (count($user->location) === 0)
				{!!Form::open(['route'=>['location-store', $user->id], 'method' => 'POST'])!!}
					{{ csrf_field() }}
					@include('locations.forms.add')
				{!!Form::close()!!}
			@else
				{!!Form::open(['route'=> ['location-update', $user->location->id], 'method' => 'put'])!!}
					{{ csrf_field() }}
					@include('locations.forms.edit')
				{!!Form::close()!!}
			@endif
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a><br><br>
</div>

@endsection