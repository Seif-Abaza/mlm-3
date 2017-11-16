@extends('layouts.admin')
@section('content')
    <h3>{{$region->name}} ({{$region->abbreviation}})</h3>
    <hr>
    @if(!Auth::guest())
        <a href="/nella/regions/{{$region->id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['RegionsController@destroy', $region->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection