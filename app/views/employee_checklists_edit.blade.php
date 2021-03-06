@extends('_master')

@section('title')
	Employee Checklists Edit
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/employee/checklists/$employee_id/edit/$checklist_id')) }}

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
			<h4><legend>{{ $checklist_item_info->name }}</legend></h4>
			{{ $checklist_item_info->description }}
			<br><br><br>

			<div class='form-group row'>
				{{ Form::label('status', 'Status', 'class=col-xs-2 col-form-label') }}
				<div class="col-xs-10">
					<div class="radio-inline">
					    {{ Form::radio('status', 'todo', ($checklist_item->status == 'todo') ? 'true' : '') }}
					    <div class="checklists_item_todo glyphicon glyphicon-remove-circle">todo</div>
					</div>
					<div class="radio-inline">
					    {{ Form::radio('status', 'pending', ($checklist_item->status == 'pending') ? 'true' : '') }}
					    <div class="checklists_item_pending glyphicon glyphicon-ban-circle">pending</div>
					</div>
					<div class="radio-inline">
					    {{ Form::radio('status', 'completed', ($checklist_item->status == 'completed') ? 'true' : '') }}
					    <div class="checklists_item_completed glyphicon glyphicon-ok-circle">completed</div>
					</div>
				</div>
			</div>
			<br>
			<div class='form-group row'>
				{{ Form::label('comments', 'Comments', 'class=col-xs-2 col-form-label') }}
			    <div class="col-xs-10">
			    	{{ Form::textarea('comments', $checklist_item->comments, array('class' => 'form-control')) }}
			    </div>
		    </div>

			<br><br>
			{{ Form::hidden('employee_id', $employee->id) }}
			{{ Form::hidden('checklist_id', $checklist_item->checklist_id) }}
		    {{ Form::submit('Save Item', array('class' => 'btn btn-primary')) }}
		    <a href=".." class="btn btn-warning">Cancel</a>
		</div>

	{{ Form::close() }}
@stop