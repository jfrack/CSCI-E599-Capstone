@extends('_master')

@section('title')
	Employee Forms
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/forms')) }}

	<div class="display_box_wide">
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

		<table class="table table-bordered table-hover">
			<th class="info">Actions</th>
			<th class="info">Form</th>
			<th class="info">Status</th>
			<th class="info">Date Completed</th>
			<tr>
				<td>
					<a href="/employee/view/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
					<a href="/employee/edit/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
					<a href="/employee/edit/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
					<a href="/employee/delete/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
				</td>
				<td>ERS Benefits Enrollment</td>
				<td><div class="employ_active glyphicon glyphicon-ok-circle">completed</div></td>
				<td>{{ BaseController::convertDateView($employee->start_date) }}</td>
			</tr>
		</table>

		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		<a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}	
@stop
