@extends('layouts.admin')
@section('content')
    <table class="table">
        <tr>
            <th>ID</th>
        </tr>
        <tr>
            <td>{{$share->id}}</td>
        </tr>
    </table>
    @if(!Auth::guest())
        {{--<a href="/nella/withdraw-requests/{{$withdraw_request->id}}/edit" class="btn btn-success">Edit</a>--}}

        {{--{!!Form::open(['action' => ['CountriesController@destroy', $withdraw_request->id], 'method' => 'POST', 'class' => 'pull-right'])!!}--}}
            {{--{{Form::hidden('_method', 'DELETE')}}--}}
            {{--{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}--}}
        {{--{!!Form::close()!!}--}}
    @endif
@endsection