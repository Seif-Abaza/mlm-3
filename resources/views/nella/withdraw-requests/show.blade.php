@extends('layouts.admin')
@section('content')
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        <tr>
            <td>{{$withdraw_request->member->first_name}} {{$withdraw_request->member->sir_name}}</td>
            <td>{{$withdraw_request->amount}}</td>
            <td>{{$withdraw_request->created_at}}</td>
        </tr>
    </table>
    @if(!Auth::guest())
        <a href="/nella/withdraw-requests/{{$withdraw_request->id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['WithdrawRequestsController@destroy', $withdraw_request->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection