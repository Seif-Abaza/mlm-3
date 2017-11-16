@extends('layouts.admin')
@section('content')
    <h3>Edit Continent</h3>
    {!! Form::open(['action' => ['ContinentsController@update', $continent->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $continent->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection