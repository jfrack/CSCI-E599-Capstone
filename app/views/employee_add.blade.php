@extends('_master')

@section('title')
	Employee Add
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

<div class="container-display_box">
	{{ Form::open(array('url' => '/employee/create')) }}

		<div class="display_box">

			<legend><h2>Add Employee</h2></legend>

			<div class='form-group row'>
			    {{ Form::label('username', 'Username', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('username', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('password', 'Password', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	<input type="password" class="form-control" id="password">
			    </div>
		    </div>

		    <div class='form-group row'>
				{{ Form::label('name', 'Name', 'class=col-xs-2 col-form-label') }}
				<div class="col-xs-10">
			    	{{ Form::text('firstname', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('middle', 'Middle', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('midlname', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('lastname', 'Lastname', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('lastname', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('nickname', 'Nickname', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('nickname', '', array('class' => 'form-control')) }}
			    </div>
		    </div>

		    <div class='form-group row'>
			    {{ Form::label('address1', 'Address1', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('address1', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('address2', 'Address2', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('address2', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('address3', 'Address3', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('address3', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('city', 'City', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('city', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('state', 'State', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('state', '', array(
			    				'class' => 'form-control bfh-selectbox bfh-states',
			    				'data-country' => 'US',
			    				'data-state' => 'TX')) }}
			    </div>
			    {{ Form::label('zipcode', 'Zip Code', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('zipcode', '', array('class' => 'form-control')) }}
			    </div>
			</div>

			<div class='form-group row'>
			    {{ Form::label('phone1', 'Phone1', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('phone1', '', array('class' => 'form-control')) }}
			    </div>
			    {{ Form::label('phone2', 'Phone2', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('phone2', '', array('class' => 'form-control')) }}
			    </div>
			</div>

			<div class='form-group row'>
			    {{ Form::label('birthdate', 'Birthdate', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('birthdate', '', array('class' => 'form-control datepicker')) }}
			    </div>
			</div>
			<div class='form-group row'>
			    {{ Form::label('gender', 'Gender', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::radio('gender', 'M', array('class' => 'radio-inline')) }} male
					{{ Form::radio('gender', 'F', array('class' => 'radio-inline')) }} female
					{{ Form::radio('gender', 'U', array('class' => 'radio-inline')) }} unspecified
				</div>
			</div>

			<div class='form-group row'>
			    {{ Form::label('start_date', 'Start Date', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::text('start_date', '', array('class' => 'form-control datepicker')) }}
			    </div>
			</div>

			<br>
		    {{ Form::submit('Add Employee', array('class' => 'btn btn-primary')) }}
		    <a href="/" class="btn btn-warning">Cancel</a>
		</div>
	{{ Form::close() }}
</div>
@stop