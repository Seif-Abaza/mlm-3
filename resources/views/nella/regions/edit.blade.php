@extends('layouts.admin')
@section('content')
    <h3>Edit Region</h3>
    {!! Form::open(['action' => ['RegionsController@update', $region->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $region->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        {{Form::label('abbreviation', 'Abbreviation')}}
        {{Form::text('abbreviation', $region->abbreviation, ['class' => 'form-control', 'placeholder' => 'Abbreviation'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection