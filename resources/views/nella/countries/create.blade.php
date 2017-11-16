@extends('layouts.admin')
@section('content')
    <h3>Create Country</h3>
    {!! Form::open(['action' => 'CountriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            <label for="continent">Continent:</label>
            <select class="form-control" id="continent" name="continent">
                <option value="">Select Continent</option>
                @foreach($continents as $continent)
                    <option value="{{$continent->id}}">{{$continent->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="region">Region:</label>
            <select class="form-control" id="region" name="region">
                <option value="">Select Region</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection