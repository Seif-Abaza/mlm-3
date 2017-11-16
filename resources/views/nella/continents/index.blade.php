@extends('layouts.admin')
@section('content')
    <h3>Continents</h3>
    <a href="/nella/continents/create" class="btn btn-success">Add Continent</a>
    @if(count($continents)>0)
        <ol>
            @foreach($continents as $continent)
                <li><h4><a href="/nella/continents/{{$continent->id}}">{{$continent->name}}</a></h4></li>
            @endforeach
        </ol>
        {{$continents->links()}}
    @else
        <p>No Continent Available</p>
    @endif
@endsection