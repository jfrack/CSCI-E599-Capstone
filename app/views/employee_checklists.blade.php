@extends('_master')

@section('title')
	Employee Checklist
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/checklists')) }}

	<div class="display_box">
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
	
		<table class="table table-bordered table-hover">
			<th class="info">Status</th>
			<th class="info">Date Completed</th>
			<th class="info">Item</th>
			<th class="info">Description</th>

			@if(sizeof($checklist) == 0)
			<tr><td>No results</td></tr>
			@else
				@foreach($checklist as $item)
					<tr>
						<td>
							@if ($employee->status == 1)
								<div class="employ_active glyphicon glyphicon-ok-circle">active</div>
							@else
								<div class="employ_term glyphicon glyphicon-ban-circle">inactive</div>
							@endif
						</td>
						<td>{{ BaseController::convertDateView($employee->start_date) }}</td>
						<td>{{ $checklist->name }}</td>
						<td>{{ $checklist->description }}</td>
					</tr>
				@endforeach
			@endif
		</table>
<!--
		@if ($contact->address1)
			{{ $contact->address1 }} <br>
		@endif
-->
		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		<a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}	
@stop
