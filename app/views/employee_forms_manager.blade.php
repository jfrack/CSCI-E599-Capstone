@extends('_master')

@section('title')
	Employee Forms Manager
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/forms_manager')) }}

	<div class="display_box_wide">
		<a href="" class="btn btn-primary">Add Form</a>
		<br><br>

		<table id="employeeFormsManagerTable" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Actions</th>
					<th>Form</th>
					<th>Description</th>
					<th>Last Update</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
					</td>
					<td>ERS Benefits Enrollment</td>
					<td>Employee Retirement System yearly benefits enrollment package</td>
					<td>12-10-2016 04:37pm</td>
				</tr>
				<tr>
					<td>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
					</td>
					<td>IRS W-4</td>
					<td>Federal employee's witholding allowance certificate</td>
					<td>08-01-2015 10:14am</td>
				</tr>
				<tr>
					<td>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-save"> Download</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"> Print</a>
						<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
					</td>
					<td>Employee Handbook</td>
					<td>State Bar of Texas employee handbook</td>
					<td>10-19-2016 03:31pm</td>
				</tr>
			</tbody>
		</table>

		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>

{{ Form::close() }}	
@stop
