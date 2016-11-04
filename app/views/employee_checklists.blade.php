@extends('_master')

@section('title')
	Employee Checklists
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/checklists')) }}

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
		<h4><legend>Employee Checklists</legend></h4>
		@if ($contact->address1)
			{{ $contact->address1 }} <br>
		@endif

		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		<a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}	
@stop
