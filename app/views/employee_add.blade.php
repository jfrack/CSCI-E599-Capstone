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

		<div class='form-group'>
		    {{ Form::label('username', 'Username:') }}
		    {{ Form::text('username') }}
		    <br>
		    {{ Form::label('password', 'Password:') }}
		    {{ Form::password('password') }}
		    <br><br>
	    </div>

	    <div class='form-group'>
			{{ Form::label('name', 'Name:') }}
		    {{ Form::text('firstname') }}
		    <br>
		    {{ Form::label('middle', 'Middle:') }}
		    {{ Form::text('midlname') }}
		    <br>
		    {{ Form::label('lastname', 'Lastname:') }}
		    {{ Form::text('lastname') }}
		    <br>
		    {{ Form::label('nickname', 'Nickname:') }}
		    {{ Form::text('nickname') }}
		    <br><br>
	    </div>

	    <div class='form-group'>
		    {{ Form::label('address1', 'Address1:') }}
		    {{ Form::text('address1') }}
		    <br>
		    {{ Form::label('address2', 'Address2:') }}
		    {{ Form::text('address2') }}
		    <br>
		    {{ Form::label('address3', 'Address3:') }}
		    {{ Form::text('address3') }}
		    <br>
		    {{ Form::label('city', 'City:') }}
		    {{ Form::text('city') }}
		    <br>
		    {{ Form::label('state', 'State:') }}
		    {{ Form::text('state', '', array(
		    			'class' => 'bfh-selectbox bfh-states',
		    			'data-country' => 'US',
		    			'data-state' => 'TX')) }}
		    <br>
		    {{ Form::label('zipcode', 'Zip code:') }}
		    {{ Form::text('zipcode') }}
		    <br><br>
		</div>

		<div class='form-group'>
		    {{ Form::label('phone1', 'Phone1:') }}
		    {{ Form::text('phone1') }}
		    <br>
		    {{ Form::label('phone2', 'Phone2:') }}
		    {{ Form::text('phone2') }}
		    <br><br>
		</div>

		<div class='form-group'>
		    {{ Form::label('birthdate', 'Birthdate:') }}
		    {{ Form::text('birthdate', '', array('class' => 'datepicker')) }}
		    <br>
		    {{ Form::label('gender', 'Gender:') }}
		    {{ Form::radio('gender', 'M', array('class' => 'radio-inline')) }} male
			{{ Form::radio('gender', 'F', array('class' => 'radio-inline')) }} female
			{{ Form::radio('gender', 'U', array('class' => 'radio-inline')) }} unspecified
			<br>
		    {{ Form::label('start_date', 'Start date:') }}
		    {{ Form::text('start_date', '', array('class' => 'datepicker')) }}
		</div>

		<br>
	    {{ Form::submit('Add Employee', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}
@stop