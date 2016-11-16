@extends('_master')

@section('title')
	User Login
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

<h3>Please login to complete your new hire forms.</h3><br>

<div class="container-small">
	{{ Form::open(array('url' => '/user/login')) }}

		<div class='form-group row'>
		    <div class="input-group">
		    	<div class="input-group-addon"><strong>Username</strong></div>
		    	{{ Form::text('username', '', array('class' => 'form-control', 'autofocus')) }}
		    </div>
		</div>
		<div class='form-group row'>
		    <div class="input-group">
		    	<div class="input-group-addon"><strong>Password</strong></div>
			    	<input type="password" class="form-control" id="password" name="password">
		    <!--
		    	{{ Form::password('password', '', array('class' => 'form-control')) }}
		    -->
		    </div>
		</div>
		<br>
	    {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')) }}

		<br><br>
		<div class="text-background">
			* If you have any questions or need assistance, please contact Human Resources at 1-800-204-2222 ext. 1489 or email
			<a href="mailto:employment@texasbar.com" target="_blank">employment@texasbar.com</a>.
		</div>
	{{ Form::close() }}
</div>
@stop