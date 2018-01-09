@extends('layouts.app')
@section('content')

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>{{ $user->name }}'s Profile <small><a href="#"></a></small></h1>
		</div>
		<div class="container">
			<img src="/avatars/{{ $user->image_path }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
			{!!Form::open(['route'=>['profile-picture', $user->id], 'files' => true, 'method' => 'post'])!!}
				{{ csrf_field() }}
				{!!Form::label('Update Profile Image')!!}
				{!!Form::file('avatar', ['required'=>'true'])!!}
				<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
				{!!Form::button('<i class="glyphicon glyphicon-cloud-upload"></i> Upload', ['class'=>'btn btn-sm btn-primary','type'=>'submit'])!!}
			{!!Form::close()!!}
		</div>
	</div>
	<a href="{{ route('profile') }}" class="btn btn-default">Go Back</a>
</div>

@endsection