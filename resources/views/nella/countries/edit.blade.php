@extends('layouts.admin')
@section('content')
    <h3>Edit Country</h3>
    {!! Form::open(['action' => ['CountriesController@update', $country->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $country->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        <label for="sel1">Continent:</label>
        <select class="form-control" id="continent" name="continent">
            <option value="{{$country->continent->id}}">{{$country->continent->name}}</option>
            @foreach($continents as $continent)
                @if($country->continent_id != $continent->id)
                    <option value="{{$continent->id}}">{{$continent->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sel1">Region:</label>
        <select class="form-control" id="region" name="region">
            <option value="{{$country->region->id}}">{{$country->region->name}}</option>
            @foreach($regions as $region)
                @if($country->region_id != $region->id)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection