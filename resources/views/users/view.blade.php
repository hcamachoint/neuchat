@extends('layouts.app')

@section('content')

<div class="container">
	<div class="well" style="background-color: white">
			<div class="page-header">
				<h1>{{ $user->name }}'s Profile <small><a href='{{ route('user-picture') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
			</div>
			<div class="container">
				<img src="/avatars/{{ $user->image_path }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
			</div>
		</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
			<div class="page-header">
				<h1>Information <small><a href='{{ route('user-information') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
			</div>
			@include('users.forms.view')
		</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Settings <small><a href='{{ route('security-index') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
		<p>Password Change & Others</p>
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Contact Methods <small><a href='{{ route('user-contact') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
				@if (count($user->contact) === 0)
        <p>There is no data associated!</p>
        @else
          @include('contacts.forms.view')
        @endif
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Skills <small><a href='{{ route('user-abilities') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
			@if (count($user->ability) === 0)
				<p>There is no data associated!</p>
			@else
				@include('abilities.forms.view')
			@endif
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Location <small><a href='{{ route('user-location') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
		@if (count($user->location) === 0)
			<p>There is no data associated!</p>
		@else
			@include('locations.forms.view')
		@endif
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Documents <small><a href='{{ route('user-documents') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
				@if (count($user->document) === 0)
        <p>There is no data associated!</p>
        @else
          @include('documents.forms.view')
        @endif
		<br>
	</div>
</div>

<div class="container">
	<div class="well" style="background-color: white">
		<div class="page-header">
			<h1>Socials <small><a href='{{ route('user-social') }}'><span class="glyphicon glyphicon-pencil"></span></a></small></h1>
		</div>
				@if (count($user->social) === 0)
        <p>There is no data associated!</p>
        @else
          @include('socials.forms.view')
        @endif
		<br>
	</div>
</div>

@endsection
