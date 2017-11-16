@extends('layouts.admin')
@section('content')
    <h3>{{$continent->name}}</h3>
    <hr>
    @if(!Auth::guest())
        <a href="/nella/continents/{{$continent->id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['ContinentsController@destroy', $continent->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection