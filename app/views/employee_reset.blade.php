@extends('_master')

@section('title')
	Employee Password Reset
@stop

@section('content')

{{ Form::open(array('url' => '/employee/reset')) }}

	<div class="display_box">

		<legend><h2>Reset Password</h2></legend>

	    <div class='form-group'>

	    	<h3>
			{{ $employee->firstname }}
			{{ $employee->midlname }}
			{{ $employee->lastname }}
			@if ($employee->nickname)
				({{ $employee->nickname }})
			@endif
			</h3><br>

	    	<strong>Username:</strong> {{ $user->username }} <br><br>

	    	<div class='form-group row'>
			    {{ Form::label('password', 'New Password', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::password('password', array('class' => 'form-control')) }}
		    	</div>
		    </div>
		    <div class='form-group row'>
			    {{ Form::label('password_confirm', 'Retype Password', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
		    		{{ Form::password('password_confirm', array('class' => 'form-control')) }}
		    	</div>
		    </div>
	    </div>

	    @foreach($errors->all() as $message)
		    <div class='error-msg'>{{ $message }}</div>
		@endforeach

	    <br>
		{{ Form::hidden('id', $user->id) }}
	    {{ Form::submit('Reset', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>

	</div>

{{ Form::close() }}
@stop