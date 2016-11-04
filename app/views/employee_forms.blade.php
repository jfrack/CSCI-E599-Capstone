@extends('_master')

@section('title')
	Employee Forms
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/employee/forms')) }}

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
		<h4><legend>Employee Forms</legend></h4>

		<br>
		{{ Form::hidden('id', $employee->id) }}
	    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		<a href="/" class="btn btn-warning">Cancel</a>
	</div>

{{ Form::close() }}	
@stop
