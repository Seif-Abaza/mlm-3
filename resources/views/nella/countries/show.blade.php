@extends('layouts.admin')
@section('content')
    <h3>{{$country->name}} is found in the <i style="color: #2ab27b">{{$country->region->name}}</i> of <i style="color: #2ab27b">{{$country->continent->name}}</i></h3>
    <hr>
    @if(!Auth::guest())
        <a href="/nella/countries/{{$country->id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['CountriesController@destroy', $country->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection