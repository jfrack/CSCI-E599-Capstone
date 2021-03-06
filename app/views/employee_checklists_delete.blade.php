@extends('_master')

@section('title')
	Employee Checklists Delete
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h3>
			{{ $employee->firstname }}
			{{ $employee->midlname }}
			{{ $employee->lastname }}
			@if ($employee->nickname)
				({{ $employee->nickname }})
			@endif
		</h3>
		<br>
		<h4><legend>
			@if ($checklist_item->status == 'completed')
				<div class="checklists_item_completed glyphicon glyphicon-ok-circle">{{ $checklist_item->status }}</div>
			@elseif ($checklist_item->status == 'pending')
				<div class="checklists_item_pending glyphicon glyphicon-ban-circle">{{ $checklist_item->status }}</div>
			@else
				<div class="checklists_item_todo glyphicon glyphicon-remove-circle">{{ $checklist_item->status }}</div>
			@endif
			<br><br>
			{{ $checklist_item_info->name }}
		</legend></h4>
		{{ $checklist_item_info->description }} <br><br>
		<strong>Comments</strong><br>
		{{ $checklist_item->comments }}

		<br><br>
		{{ Form::open(array('url' => '/employee/checklists/$employee_id/delete/$checklist_id')) }}
			{{ Form::hidden('employee_id', $employee->id) }}
			{{ Form::hidden('checklist_id', $checklist_item->checklist_id) }}
			{{ Form::hidden('checklist_created_at', $checklist_item->created_at) }}
		    {{ Form::submit('Delete Item', array('class' => 'btn btn-primary')) }}
		    <a href=".." class="btn btn-warning">Cancel</a>
		{{ Form::close() }}

	</div>
@stop