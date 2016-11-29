@extends('_master')

@section('title')
	Employee Checklist
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class="error">{{ $message }}</div>
	@endforeach

<!--
	{{ Form::open(array('url' => '/employee/checklists')) }}
-->
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

			{{ Form::open(array('url' => '/employee/checklists/$employee->id/add/$item->id')) }}
				<div class="container-large">
					<div class="container-small">
						{{ Form::label('checklist_id', 'checklist_id', 'class=col-xs-2 col-form-label hidden') }}
						{{ Form::select('checklist_id', $checklist_selection, null, array('class' => 'form-control')) }}
					</div>
					{{ Form::hidden('employee_id', $employee->id) }}
			    	{{ Form::submit('Add Item', array('class' => 'btn btn-primary button-layout')) }}
				</div>
				<br><br><br>
			{{ Form::close() }}
		
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
								<a href="/employee/checklists/{{ $employee->id }}/edit/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"> Edit</a>
								<a href="/employee/checklists/{{ $employee->id }}/delete/{{ $item->id }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"> Delete</a>
							</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->description }}</td>
							<td>
								@if ($item->status == 'completed')
									<div class="checklists_item_completed glyphicon glyphicon-ok-circle">{{ $item->status }}</div>
								@else
									<div class="checklists_item_todo glyphicon glyphicon-ban-circle">{{ $item->status }}</div>
								@endif
							</td>
							<td>{{ BaseController::convertDateTimeView($item->updated_at) }}</td>
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
<!--
	{{ Form::close() }}	
-->
@stop
