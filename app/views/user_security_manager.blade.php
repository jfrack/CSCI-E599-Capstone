@extends('_master')

@section('title')
	User Security Manager
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class="error">{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/user/security_manager')) }}

		<div class="display_box_wide">

			{{-- todo
			{{ Form::open(array('url' => '/user/security_manager/add')) }}
			{{ Form::submit('Add Role', array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
			--}}

			<a href="" class="btn btn-primary">Add Role</a>
			<br><br>
		
			<table class="table table-bordered table-hover">
				<th>Actions</th>
				<th>Role</th>
				<th>Description</th>
				<th>Last Update</th>

				@if(sizeof($roles) == 0)
				<tr><td>No items found</td></tr>
				@else
					@foreach($roles as $role)
						<tr>
							<td>
								{{-- todo
								<a href="/user/security_manager/edit/{{ $role->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								<a href="/user/security_manager/delete/{{ $role->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
								--}}

								<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>								
							</td>
							<td>{{ $role->name }}</td>
							<td>{{ $role->description }}</td>
							<td>{{ BaseController::convertDateTimeView($role->updated_at) }}</td>
						</tr>
					@endforeach
				@endif
			</table>

			<br>
			<a href=".." class="btn btn-primary">Back</a>
		</div>	
@stop
