@extends('_master')

@section('title')
	User Login
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='error'>{{ $message }}</div>
@endforeach

<h4>Please login to update your profile and submit forms.</h4><br>

{{ Form::open(array('url' => '/user/login')) }}

    {{ Form::label('username:') }}
    {{ Form::text('username') }}<br><br>

    {{ Form::label('password:') }}
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Log in', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop