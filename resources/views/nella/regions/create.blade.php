@extends('layouts.admin')
@section('content')
    <h3>Create Region</h3>
    {!! Form::open(['action' => 'RegionsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
            {{Form::label('abbreviation', 'Abbreviation')}}
            {{Form::text('abbreviation', '', ['class' => 'form-control', 'placeholder' => 'Abbreviation'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection