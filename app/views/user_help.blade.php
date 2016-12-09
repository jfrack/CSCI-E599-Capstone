@extends('_master')

@section('title')
	User Help
@stop

@section('content')
	@foreach($errors->all() as $message)
	    <div class='error'>{{ $message }}</div>
	@endforeach

	<div class="display_box">
		<h3>Help Menu</h3>
		<br>Please select a topic:<br><br>
		<ol>
			<li><a href="">User Security</a></li>
			<li><a href="">Employee Manager</a></li>
			<li><a href="">Forms Manager</a></li>
			<li><a href="">Checklists Manager</a></li>
		</ol>


		<br>
		<a href="/" class="btn btn-primary">Back</a>
	</div>
@stop