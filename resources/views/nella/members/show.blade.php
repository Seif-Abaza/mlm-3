@extends('layouts.admin')
@section('content')
    <h3><b>Member:</b> {{$member->first_name}} {{$member->sir_name}}</h3>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <td>Name</td>
                <td>Country</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Shares</td>
                <td>Upline</td>
                <td>Sponsor</td>
                <td>Joined</td>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$member->first_name}} {{$member->sir_name}}</td>
                <td>{{$member->country->name}}</td>
                <td>{{$member->phone}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->shares}}</td>
                <td>{{$member->ofUpline->first_name}}</td>
                <td>{{$member->ofSponsor->first_name}}</td>
                <td>{{$member->created_at->format('jS F Y')}}</td>
                <td><a href="/nella/members/{{$member->id}}/renew" class="btn btn-sm btn-success">Renew</a></td>
            </tr>
        </tbody>
    </table>
    @if(!Auth::guest())
        <a href="/nella/members/{{$member->id}}/edit" class="btn btn-success">Edit Member Details</a>
        {{--{!!Form::open(['action' => ['MembersController@destroy', $member->id], 'method' => 'POST', 'class' => 'pull-right'])!!}--}}
            {{--{{Form::hidden('_method', 'DELETE')}}--}}
            {{--{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}--}}
        {{--{!!Form::close()!!}--}}
    @endif
    <hr>
    <h3><b>Shares</b></h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>UUID</th>
            <th>Create Date</th>
            <th>First Payment</th>
            <th>Pay Times</th>
            <th>Each Payment</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shares as $share)
            <tr>
                <td>{{$share->id}}</td>
                <td>{{$share->uuid}}</td>
                <td>{{$share->created_at}}</td>
                <td>{{$share->begin_pay}}</td>
                <td>{{$share->pay_times}}</td>
                <td>{{$share->amount}}</td>
                <td><a href="/nella/shares/{{$share->id}}/renew" class="btn btn-sm btn-success">Renew Share</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/nella/shares/create" class="btn btn-success">Add Share</a>
    <hr>
    <h3><b>Earnings</b></h3>
    <table class="table">
        <thead>
        <tr>
            <th>Type</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($earnings as $earning)
            <tr>
                <td>{{$earning->ofType->name}}</td>
                <td>{{$earning->amount}}</td>
                <td>{{$earning->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection