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

			<div class="container-large">
				<div class="container-small">
					<select class="form-control">
						@foreach($checklist as $item)
						    <option>{{ $item->name }}</option>
						@endforeach
					</select>
				</div>
				<a href="" class="btn btn-primary button-layout">Add Item</a>
			</div>
			<br><br><br>
		
			<table class="table table-bordered table-hover">
				<th>Actions</th>
				<th>Item</th>
				<th>Description</th>
				<th>Status</th>
				<th>Last Update</th>

				@if(sizeof($checklist_employee) == 0)
				<tr><td>No items found</td></tr>
				@else
					@foreach($checklist_employee as $item)
						<tr>
							<td>
								<!--
								<a href="/" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								-->
								<a href="" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list-alt"> Comments</a>
								<a href="/employee/checklists/delete/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
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
							<td>{{ $item->updated_at }}</td>
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
