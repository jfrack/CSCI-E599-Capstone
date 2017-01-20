@extends('_master')

@section('title')
	Employee Checklists Manager
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class="error">{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/employee/checklists_manager')) }}

		<div class="display_box_wide">

			{{-- todo
			{{ Form::open(array('url' => '/employee/checklists_manager/add')) }}
			{{ Form::submit('Add Item', array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
			--}}

			<a href="" class="btn btn-primary">Add Item</a>
			<br><br>
		
			<table id="employeeChecklistsManagerTable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Actions</th>
						<th>Item</th>
						<th>Description</th>
						<th>Last Update</th>
					</tr>
				</thead>
				<tbody>
					@if(sizeof($checklists) == 0)
					<tr><td>No items found</td></tr>
					@else
						@foreach($checklists as $item)
							<tr>
								<td>
									<a href="/employee/checklists_manager/edit/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
									<a href="/employee/checklists_manager/delete/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
								</td>
								<td>{{ $item->name }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ BaseController::convertDateTimeView($item->updated_at) }}</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>

			<br>
			<a href=".." class="btn btn-primary">Back</a>
		</div>	
@stop
