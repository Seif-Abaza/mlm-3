@extends('layouts.admin')
@section('content')
    <h3>Countries</h3>
    <a href="/nella/countries/create" class="btn btn-success">Add Country</a>
    <br>
    <br>
    @if(count($countries)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Country</th>
                <th>Region</th>
                <th>Continent</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($countries as $country)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td><a href="/nella/countries/{{$country->id}}">{{$country->name}}</a></td>
                    <td>{{$country->region->name}}</td>
                    <td>{{$country->continent->name}}</td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
        {{$countries->links()}}
    @else
        <p>No Countries Available</p>
    @endif
@endsection