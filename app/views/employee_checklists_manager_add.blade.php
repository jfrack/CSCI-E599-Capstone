@extends('_master')

@section('title')
	Checklists Manager Add
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

<div class="container-large">
	{{ Form::open(array('url' => '/employee/checklists_manager/add')) }}

		<div class="display_box">

			<legend><h2>Add Item</h2></legend>

			<div class='form-group row'>
				{{ Form::label('item', 'Item', 'class=col-xs-2 col-form-label') }}
				<div class="col-xs-10">
			    	{{ Form::text('item', '', array('class' => 'form-control')) }}
			    </div>
			</div>
			<div class='form-group row'>
			    {{ Form::label('description', 'Description', 'class=col-xs-2 col-form-label') }}
				<div class="col-xs-10">
			    	{{ Form::text('description', '', array('class' => 'form-control')) }}
			    </div>
			</div>

				<br>
			    {{ Form::submit('Add Item', array('class' => 'btn btn-primary')) }}
			    <a href="/employee/checklists_manager" class="btn btn-warning">Cancel</a>
		</div>
	{{ Form::close() }}
</div>
@stop