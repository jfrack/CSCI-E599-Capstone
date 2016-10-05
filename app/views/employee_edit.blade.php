@extends('_master')

@section('title')
	Employee Edit
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/employee/edit')) }}

	<div class="display_box">

		<legend>Edit Employee</legend>

		<div class='form-group'>
			{{ Form::label('status', 'Status:') }}
			<div class="radio-inline">
			    {{ Form::radio('status', '1', ($employee->status == 1) ? 'true' : '') }} active
			</div>
			<div class="radio-inline">
			    {{ Form::radio('status', '0', ($employee->status == 0) ? 'true' : '') }} inactive
			</div>
		</div>

	    <div class='form-group'>
			{{ Form::label('name', 'Name:') }}
		    {{ Form::text('firstname', $employee->firstname) }}
		    <br>
		    {{ Form::label('middle', 'Middle:') }}
		    {{ Form::text('midlname', $employee->midlname) }}
		    <br>
		    {{ Form::label('lastname', 'Lastname:') }}
		    {{ Form::text('lastname', $employee->lastname) }}
		    <br>
		    {{ Form::label('nickname', 'Nickname:') }}
		    {{ Form::text('nickname', $employee->nickname) }}
		    <br><br>
	    </div>

	    <div class='form-group'>
		    {{ Form::label('address1', 'Address1:') }}
		    {{ Form::text('address1', $contact->address1) }}
		    <br>
		    {{ Form::label('address2', 'Address2:') }}
		    {{ Form::text('address2', $contact->address2) }}
		    <br>
		    {{ Form::label('address3', 'Address3:') }}
		    {{ Form::text('address3', $contact->address3) }}
		    <br>
		    {{ Form::label('city', 'City:') }}
		    {{ Form::text('city', $contact->city) }}
		    <br>
		    {{ Form::label('state', 'State:') }}
		    {{ Form::text('state', $contact->state, array(
		    			'class' => 'bfh-selectbox bfh-states',
		    			'data-country' => 'US',
		    			'data-state' => 'TX')) }}
		    <br>
		    {{ Form::label('zipcode', 'Zip code:') }}
		    {{ Form::text('zipcode', $contact->zipcode) }}
		    <br><br>
		</div>

		<div class='form-group'>
		    {{ Form::label('phone1', 'Phone1:') }}
		    {{ Form::text('phone1', $contact->phone1) }}
		    <br>
		    {{ Form::label('phone2', 'Phone2:') }}
		    {{ Form::text('phone2', $contact->phone2) }}
		    <br><br>
		</div>

		<div class='form-group'>
		    {{ Form::label('birthdate', 'Birthdate:') }}
		    {{ Form::text('birthdate', BaseController::convertDateView($employee->birthdate), array('class' => 'datepicker')) }}
		    <br>
		    {{ Form::label('gender', 'Gender:') }}
		    <div class="radio-inline">
			    {{ Form::radio('gender', 'M', ($employee->gender == 'M') ? 'true' : '') }} male
			</div>
			<div class="radio-inline">
				{{ Form::radio('gender', 'F', ($employee->gender == 'F') ? 'true' : '') }} female
			</div>
			<div class="radio-inline">
				{{ Form::radio('gender', 'U', ($employee->gender == 'U') ? 'true' : '') }} unspecified
			</div>
			<br>
		    {{ Form::label('start_date', 'Start date:') }}
		    {{ Form::text('start_date', BaseController::convertDateView($employee->start_date), array('class' => 'datepicker')) }}
		</div>

		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>
    </div>

{{ Form::close() }}
@stop