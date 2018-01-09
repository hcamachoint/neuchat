@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Information <small><a href="#"></a></small></h1>
		</div>
			{!! Form::open(['route' => ['profile-update', $user->id], 'method' => 'put']) !!}
				{{ csrf_field() }}
				@include('users.forms.edit')
			{!! Form::close() !!}
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a><br><br>
</div>

@endsection