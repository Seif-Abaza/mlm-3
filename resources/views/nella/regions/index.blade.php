@extends('layouts.admin')
@section('content')
    <h3>Regions</h3>
    <a href="/nella/regions/create" class="btn btn-success">Add Region</a>
    @if(count($regions)>0)
        <ol>
            @foreach($regions as $region)
                <li><h4><a href="/nella/regions/{{$region->id}}">{{$region->name}}</a> ({{$region->abbreviation}})</h4></li>
            @endforeach
        </ol>
        {{$regions->links()}}
    @else
        <p>No Region Available</p>
    @endif
@endsection