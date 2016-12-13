@extends('_master')

@section('title')
	Employee Checklists Manager Edit
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/employee/checklists_manager/edit/$checklist_id')) }}
	<div class="display_box">
		
		<h4><legend>Checklist Item Edit</legend></h4>

		<div class='form-group row'>
			{{ Form::label('item', 'Item', 'class=col-xs-2 col-form-label') }}
			<div class="col-xs-10">
		    	{{ Form::text('item', $checklist_item->name, array('class' => 'form-control')) }}
		    </div>
		</div>
		<div class='form-group row'>
		    {{ Form::label('description', 'Description', 'class=col-xs-2 col-form-label') }}
			<div class="col-xs-10">
		    	{{ Form::text('description', $checklist_item->description, array('class' => 'form-control')) }}
		    </div>
		</div>
		<br>
			
		{{ Form::hidden('checklist_id', $checklist_item->id) }}
		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		<a href=".." class="btn btn-warning">Cancel</a>

	</div>
	{{ Form::close() }}
@stop