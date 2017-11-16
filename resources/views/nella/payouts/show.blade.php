@extends('layouts.admin')
@section('content')
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        <tr>
            <td>{{$payout->share->member->first_name}} {{$payout->share->member->sir_name}}</td>
            <td>{{$payout->amount}}</td>
            <td>{{$payout->created_at}}</td>
        </tr>
    </table>
    @if(!Auth::guest())
        <a href="/nella/payouts/{{$payout->id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['PayoutsController@destroy', $payout->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection