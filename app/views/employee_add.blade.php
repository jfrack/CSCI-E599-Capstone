@extends('_master')

@section('title')
	Employee Add
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/employee/create')) }}

	<div class="display_box">

		<legend>Add Employee</legend>

		<div class='form-group row'>
		    {{ Form::label('username', 'Username:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('username') }}
		    <br>
		    {{ Form::label('password', 'Password:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::password('password') }}
		    <br><br>
	    </div>

	    <div class='form-group row'>
			{{ Form::label('name', 'Name:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('firstname') }}
		    <br>
		    {{ Form::label('middle', 'Middle:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('midlname') }}
		    <br>
		    {{ Form::label('lastname', 'Lastname:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('lastname') }}
		    <br>
		    {{ Form::label('nickname', 'Nickname:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('nickname') }}
		    <br><br>
	    </div>

	    <div class='form-group row'>
		    {{ Form::label('address1', 'Address1:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('address1') }}
		    <br>
		    {{ Form::label('address2', 'Address2:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('address2') }}
		    <br>
		    {{ Form::label('address3', 'Address3:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('address3') }}
		    <br>
		    {{ Form::label('city', 'City:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('city') }}
		    <br>
		    {{ Form::label('state', 'State:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('state', '', array(
		    			'class' => 'bfh-selectbox bfh-states',
		    			'data-country' => 'US',
		    			'data-state' => 'TX')) }}
		    <br>
		    {{ Form::label('zipcode', 'Zip Code:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('zipcode') }}
		    <br><br>
		</div>

		<div class='form-group row'>
		    {{ Form::label('phone1', 'Phone1:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('phone1') }}
		    <br>
		    {{ Form::label('phone2', 'Phone2:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('phone2') }}
		    <br><br>
		</div>

		<div class='form-group row'>
		    {{ Form::label('birthdate', 'Birthdate:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('birthdate', '', array('class' => 'datepicker')) }}
		    <br>
		    {{ Form::label('gender', 'Gender:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::radio('gender', 'M', array('class' => 'radio-inline')) }} male
			{{ Form::radio('gender', 'F', array('class' => 'radio-inline')) }} female
			{{ Form::radio('gender', 'U', array('class' => 'radio-inline')) }} unspecified
		</div>

		<div class='form-group row'>
		    {{ Form::label('start_date', 'Start Date:', 'class=col-xs-2 col-form-label') }}
		    {{ Form::text('start_date', '', array('class' => 'datepicker')) }}
		</div>

		<br>
	    {{ Form::submit('Add Employee', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}
@stop