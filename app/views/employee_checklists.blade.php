@extends('_master')

@section('title')
	Employee Checklists
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h3>
			Employee Checklists
		</h3>

		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>
@stop
