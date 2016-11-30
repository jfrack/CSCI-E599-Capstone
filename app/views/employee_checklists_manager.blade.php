@extends('_master')

@section('title')
	Employee Checklists Manager
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class="error">{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/employee/checklists/manager')) }}

		<div class="display_box_wide">

			{{ Form::open(array('url' => '/employee/checklists/$employee->id/add/$item->id')) }}
			{{ Form::submit('Add Item', array('class' => 'btn btn-primary button-layout')) }}
			<br><br>
		
			<table class="table table-bordered table-hover">
				<th>Actions</th>
				<th>Item</th>
				<th>Description</th>
				<th>Last Update</th>

				@if(sizeof($checklists) == 0)
				<tr><td>No items found</td></tr>
				@else
					@foreach($checklists as $item)
						<tr>
							<td>
								<!--
								<a href="/" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								-->
								<a href="/employee/checklists/{{ $item->id }}/edit/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								<a href="/employee/checklists/{{ $item->id }}/delete/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
							</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->description }}</td>
							<td>{{ BaseController::convertDateTimeView($item->updated_at) }}</td>
						</tr>
					@endforeach
				@endif
			</table>

			<br>
			<a href="/" class="btn btn-primary">Back</a>
		</div>

	{{ Form::close() }}	
@stop
