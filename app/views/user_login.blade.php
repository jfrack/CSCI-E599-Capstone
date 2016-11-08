@extends('_master')

@section('title')
	User Login
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

<h3>Please login to complete your new hire forms.</h3><br>

{{ Form::open(array('url' => '/user/login')) }}

	<h4>
	<div class='form-group row'>
	    {{ Form::label('username', 'Username', 'class="col-xs-1 col-form-label"') }}
	    {{ Form::text('username') }}<br><br>

	    {{ Form::label('password', 'Password', 'class="col-xs-1 col-form-label"') }}
	    {{ Form::password('password') }}<br><br><br>

	    {{ Form::submit('Log in', array('class' => 'btn btn-primary')) }}
	</div>
	</h4>
	<br>
	<div class="text-background">
		* If you have any questions or need assistance, please contact Human Resources at 1-800-204-2222 ext. 1489 or email
		<a href="mailto:employment@texasbar.com" target="_blank">employment@texasbar.com</a>.
	</div>
{{ Form::close() }}
@stop