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

		<legend><h2>Edit Employee</h2></legend>

		<div class='form-group row'>
			{{ Form::label('status', 'Status', 'class=col-xs-2 col-form-label') }}
			<div class="col-xs-10">
				<div class="radio-inline">
				    {{ Form::radio('status', '1', ($employee->status == 1) ? 'true' : '') }} active
				</div>
				<div class="radio-inline">
				    {{ Form::radio('status', '0', ($employee->status == 0) ? 'true' : '') }} inactive
				</div>
			</div>
		</div>

	    <div class='form-group row'>
			{{ Form::label('name', 'Name', 'class=col-xs-2 col-form-label') }}
			<div class="col-xs-10">
		    	{{ Form::text('firstname', $employee->firstname, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('middle', 'Middle', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('midlname', $employee->midlname, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('lastname', 'Lastname', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('lastname', $employee->lastname, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('nickname', 'Nickname', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('nickname', $employee->nickname, array('class' => 'form-control')) }}
		    </div>
	    </div>

	    <div class='form-group row'>
		    {{ Form::label('address1', 'Address1', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('address1', $contact->address1, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('address2', 'Address2', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('address2', $contact->address2, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('address3', 'Address3', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('address3', $contact->address3, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('city', 'City', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('city', $contact->city, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('state', 'State', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('state', $contact->state, array(
		    				'class' => 'form-control bfh-selectbox bfh-states',
		    				'data-country' => 'US',
		    				'data-state' => 'TX')) }}
		    </div>
		    {{ Form::label('zipcode', 'Zip Code', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('zipcode', $contact->zipcode, array('class' => 'form-control')) }}
		    </div>
		</div>

		<div class='form-group row'>
		    {{ Form::label('phone1', 'Phone1', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('phone1', $contact->phone1, array('class' => 'form-control')) }}
		    </div>
		    {{ Form::label('phone2', 'Phone2', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('phone2', $contact->phone2, array('class' => 'form-control')) }}
		    </div>
		</div>

		<div class='form-group row'>
		    {{ Form::label('birthdate', 'Birthdate', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
		    	{{ Form::text('birthdate', BaseController::convertDateView($employee->birthdate), array('class' => 'form-control datepicker')) }}
		    </div>
		</div>

		<div class='form-group row'>
		    {{ Form::label('gender', 'Gender', 'class=col-xs-2 col-form-label') }}
		    <div class="col-xs-10">
			    <div class="radio-inline">
				    {{ Form::radio('gender', 'M', ($employee->gender == 'M') ? 'true' : '') }} male
				</div>
				<div class="radio-inline">
					{{ Form::radio('gender', 'F', ($employee->gender == 'F') ? 'true' : '') }} female
				</div>
				<div class="radio-inline">
					{{ Form::radio('gender', 'U', ($employee->gender == 'U') ? 'true' : '') }} unspecified
				</div>
			</div>
		</div>

		<div class='form-group row'>
		    {{ Form::label('start_date', 'Start Date', 'class=col-xs-2 col-form-label') }}
		    <div class='col-xs-10'>
		    	{{ Form::text('start_date', BaseController::convertDateView($employee->start_date), array('class' => 'form-control datepicker')) }}
		    </div>
		</div>

		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	    <a href="/" class="btn btn-warning">Cancel</a>
    </div>

{{ Form::close() }}
@stop