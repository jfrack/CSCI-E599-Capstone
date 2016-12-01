@extends('_master')

@section('title')
	User Security
@stop

@section('content')

	@foreach($errors->all() as $message)
	    <div class="error">{{ $message }}</div>
	@endforeach

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

		{{ Form::open(array('url' => '/user/security/$employee->id/add/$role->id')) }}
			<div class="container-large">
				<div class="container-small">
					{{ Form::label('role_selection', 'role_selection', 'class=col-xs-2 col-form-label hidden') }}
					{{ Form::select('role_selection', $role_selection, null, array('class' => 'form-control')) }}
				</div>
				{{ Form::hidden('employee_id', $employee->id) }}
		    	{{ Form::submit('Add Role', array('class' => 'btn btn-primary button-layout')) }}
			</div>
			<br><br><br>
		{{ Form::close() }}

		<table class="table table-bordered table-hover">
			<th>Actions</th>
			<th>Role</th>
			<th>Description</th>

			@if(sizeof($role_user) == 0)
				<tr><td>No items found</td></tr>
			@else
				@foreach($role_user as $role)
					<tr>
						<td>
							<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
						</td>
						<td>{{ $role->name }}</td>
						<td>{{ $role->description }}</td>
					</tr>
				@endforeach
			@endif
		</table>
		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>
@stop
