@extends('_master')

@section('title')
	Employee Checklists Delete
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">

		<legend><h2>Delete Checklist Item</h2></legend>

		<h3>
			{{ $employee->firstname }}
			{{ $employee->midlname }}
			{{ $employee->lastname }}
			@if ($employee->nickname)
				({{ $employee->nickname }})
			@endif
		</h3>
		<br>
		<h4><legend>Item</legend></h4>
			@if ($checklist_item_info->name)
				{{ $checklist_item_info->name }} <br>
			@endif
		<br>
		{{ Form::open(array('url' => '/employee/checklists/$employee_id/delete/$item_id')) }}
			{{ Form::hidden('$employee_id', $employee->id) }}
		    {{ Form::submit('Delete', array('class' => 'btn btn-primary')) }}
		    <a href=".." class="btn btn-warning">Cancel</a>
		{{ Form::close() }}

	</div>
@stop