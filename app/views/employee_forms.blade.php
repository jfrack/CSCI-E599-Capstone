@extends('_master')

@section('title')
	Employee Forms
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h3>
			Employee Forms
		</h3>

		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>
@stop
