@extends('_master')

@section('title')
	Employee Password Reset
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/employee/reset')) }}

	<div class="display_box">

		<legend>Reset Password</legend>

	    <div class='form-group'>

	    	<h3>
			{{ $employee->firstname }}
			{{ $employee->midlname }}
			{{ $employee->lastname }}
			@if ($employee->nickname)
				({{ $employee->nickname }})
			@endif
			</h3>

	    	<strong>Username:</strong> {{ $user->username }} <br>
		    {{ Form::label('password', 'New Password:') }}
		    {{ Form::password('password') }}
		    {{ Form::label('password_confirm', 'Retype Password:') }}
		    {{ Form::password('password_confirm') }}
	    </div>

		{{ Form::hidden('id', $user->id) }}
	    {{ Form::submit('Reset', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>

	</div>

{{ Form::close() }}
@stop