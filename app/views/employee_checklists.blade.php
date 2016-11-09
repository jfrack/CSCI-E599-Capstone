@extends('_master')

@section('title')
	Employee Checklist
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/checklists')) }}

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

		<a href="/" class="btn btn-primary">Add Item</a>
		<br><br>
	
		<table class="table table-bordered table-hover">
			<th>Actions</th>
			<th>Item</th>
			<th>Description</th>
			<th>Status</th>
			<th>Date Completed</th>

			@if(sizeof($checklist) == 0)
			<tr><td>No items found</td></tr>
			@else
				@foreach($checklist as $item)
					<tr>
						<td>
							<a href="/" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
							<a href="/" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list-alt"> Comments</a>
							<a href="/" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
						</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->description }}</td>
						<td>
							@if ($item->status == 'completed')
								<div class="employ_active glyphicon glyphicon-ok-circle">{{ $item->status }}</div>
							@else
								<div class="employ_term glyphicon glyphicon-ban-circle">{{ $item->status }}</div>
							@endif
						</td>
						<td>n/a</td>
					</tr>
				@endforeach
			@endif
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
