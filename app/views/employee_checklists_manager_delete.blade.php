@extends('_master')

@section('title')
	Employee Checklists Manager Delete
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h4><legend>{{ $checklist_item->name }}</legend></h4>
		{{ $checklist_item->description }}
		<br><br>
		<div class='alert alert-danger'>
			<span class="glyphicon glyphicon-exclamation-sign"></span>
			Are you sure you want to delete this item from the checklist manager?
		</div>
		<br>
		{{ Form::open(array('url' => '/employee/checklists_manager/delete/$checklist_id')) }}
			{{ Form::hidden('checklist_id', $checklist_item->id) }}
		    {{ Form::submit('Delete Item', array('class' => 'btn btn-primary')) }}
		    <a href=".." class="btn btn-warning">Cancel</a>
		{{ Form::close() }}

	</div>
@stop