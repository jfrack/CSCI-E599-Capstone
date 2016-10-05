@extends('_master')

@section('title')
	Employee View
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h3>
			{{ $employee->firstname }}
			{{ $employee->midlname }}
			{{ $employee->lastname }}
			@if ($employee->nickname)
				({{ $employee->nickname }})
			@endif
		</h3>

		@if ($employee->status == 1)
			<div class="employ_active glyphicon glyphicon-ok-circle">active</div>
		@else
			<div class="employ_term glyphicon glyphicon-ban-circle">inactive</div>
		@endif
		<br><br>
		<h4><legend>Home Address</legend></h4>
		@if ($contact->address1)
			{{ $contact->address1 }} <br>
		@endif
		@if ($contact->address2)
			{{ $contact->address2 }} <br>
		@endif
		@if ($contact->address3)
			{{ $contact->address3 }} <br>
		@endif
		@if ($contact->city)
			{{ $contact->city }},
		@endif
		@if ($contact->state)
			{{ $contact->state }}
		@endif
		@if ($contact->zipcode)
			{{ $contact->zipcode }} <br>
		@endif
		<br>
		<h4><legend>Phone</legend></h4>
		@if ($contact->phone1)
			{{ $contact->phone1 }} <br>
		@endif
		@if ($contact->phone2)
			{{ $contact->phone2 }} <br>
		@endif
		<br>
		<h4><legend>Personal Info</legend></h4>

		Start Date: {{ BaseController::convertDateView($employee->start_date) }} <br>
		End Date: {{ BaseController::convertDateView($employee->end_date) }} <br>
		Birthdate: {{ BaseController::convertDateView($employee->birthdate) }} <br>

		Gender: {{ $employee->gender }} <br>

		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>
@stop