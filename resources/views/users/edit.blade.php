@extends('layouts.app')

@section('content')

<div class="container">
	<div class="well" style="background-color: white">
			<div class="page-header">
				<h1>{{ $user->name }}'s Profile <small><a href="#"></a></small></h1>
			</div>
			<div class="container">
				<img src="/avatars/{{ $user->image_path }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
				<form enctype="multipart/form-data" action="/profile/picture/{{$user->id}}" method="POST">
						<label>Update Profile Image</label>
						<input type="file" name="avatar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-sm btn-primary">
				</form>
			</div>
		</div>
</div>

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
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Contact Methods <small><a href="#"></a></small></h1>
		</div>
		@if (count($user->contact) === 0)
			<p>There is no data associated!</p>
		@else
			@foreach($user->contact as $cont)
			  {!!Form::open(['route'=>['contact-update', $cont->id], 'method' => 'put'])!!}
			  		{{ csrf_field() }}
					@include('contacts.forms.edit')
				{!!Form::close()!!}
				{!!Form::open(['route'=>['contact-destroy', $cont->id], 'method' => 'delete'])!!}
					{{ csrf_field() }}
					@include('contacts.forms.del')
				{!!Form::close()!!}
			@endforeach
		@endif
		<br>
		{!!Form::open(['route'=>['contact-store', $user->id], 'method' => 'post'])!!}
			{{ csrf_field() }}
			@include('contacts.forms.add')
		{!!Form::close()!!}
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Skills <small><a href="#"></a></small></h1>
		</div>
			@if (count($user->ability) === 0)
				<p>There is no data associated!</p>
			@else
				@foreach($user->ability as $ab)
					{!!Form::open(['route'=> ['abilityp-destroy', $ab->id], 'method' => 'delete'])!!}
						{{ csrf_field() }}
						@include('abilities.forms.del')
					{!!Form::close()!!}
				@endforeach
			@endif
			<br>
			{!!Form::open(['route'=>'abilityp-store', 'method' => 'post'])!!}
				{{ csrf_field() }}
				@include('abilities.forms.add')
			{!!Form::close()!!}
		<br>
	</div>
</div>

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
			<br>

		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Documents <small><a href="#"></a></small></h1>
		</div>
		@if (count($user->document) === 0)
			<p>There is no data associated!</p>
		@else
			@foreach($user->document as $doc)
			  {!!Form::open(['route'=>['document-update', $doc->id], 'method' => 'put'])!!}
			  	{{ csrf_field() }}
					@include('documents.forms.edit')
				{!!Form::close()!!}
				{!!Form::open(['route'=>['document-destroy', $doc->id],'method' => 'delete'])!!}
					{{ csrf_field() }}
					@include('documents.forms.del')
				{!!Form::close()!!}
			@endforeach
		@endif
		<br>
		{!!Form::open(['route'=>['document-store', $user->id], 'method' => 'post'])!!}
			{{ csrf_field() }}
			@include('documents.forms.add')
		{!!Form::close()!!}
		<br>
	</div>
</div>

@endsection
