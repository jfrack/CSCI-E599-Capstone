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
		<br>
		<a href="" class="btn btn-primary">Add Form</a>
		<br><br>

		<table class="table table-bordered table-hover">
			<th>Actions</th>
			<th>Form</th>
			<th>Status</th>
			<th>Date Completed</th>
			<tr>
				<td>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
				</td>
				<td>ERS Benefits Enrollment</td>
				<td><div class="employ_active glyphicon glyphicon-ok">completed</div></td>
				<td>{{ BaseController::convertDateView($employee->start_date) }}</td>
			</tr>
			<tr>
				<td>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
				</td>
				<td>IRS W-4</td>
				<td><div class="employ_term glyphicon glyphicon-remove">todo</div></td>
				<td>n/a</td>
			</tr>
			<tr>
				<td>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
					<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
				</td>
				<td>Employee Handbook</td>
				<td><div class="employ_term glyphicon glyphicon-remove">todo</div></td>
				<td>n/a</td>
			</tr>
		</table>

		<br>
		<!--
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	    -->
		<a href="/" class="btn btn-primary">Back</a>
	</div>

{{ Form::close() }}	
@stop
