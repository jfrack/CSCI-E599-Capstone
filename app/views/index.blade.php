@extends('_master')

@section('title')
	Index
@stop

@section('nav')
	<a href="/employee/create" class="btn btn-primary">Add Employee</a>
	<a href="/" class="btn btn-primary">Manage Forms</a>
	<a href="/" class="btn btn-primary">Manage Checklists</a>
	<a href="/user/logout" class="btn btn-warning">Logout {{ Auth::user()->username }}</a>
	<br><br>
@stop

@section('content')
	<table class="table table-bordered table-hover">
		<th class="info">Actions</th>
		<th class="info">Employee</th>
		<th class="info">Status</th>
		<th class="info">Start Date</th>
		<th class="info">Last Login</th>

		@if(sizeof($employees) == 0)
			<tr><td>No results</td></tr>
		@else
			@foreach($employees as $employee)
				<tr>
					<td>
						<a href="/employee/view/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"> View</a>
						<a href="/employee/edit/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
						<a href="/employee/reset/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-user"> Reset Password</a>
						@if ($employee->user_id != 1)
							<a href="/employee/delete/{{ $employee->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
						@endif
					</td>
					<td>{{ $employee->lastname }}, {{ $employee->firstname }}</td>
					<td>
						@if ($employee->status == 1)
							<div class="employ_active glyphicon glyphicon-ok-circle">active</div>
						@else
							<div class="employ_term glyphicon glyphicon-ban-circle">inactive</div>
						@endif
					</td>
					<td>{{ BaseController::convertDateView($employee->start_date) }}</td>
					<td>{{ BaseController::convertDateTimeView(User::where('id', '=', $employee->user_id)->first()->last_login) }}</td>
				</tr>
			@endforeach
		@endif
	</table>
@stop