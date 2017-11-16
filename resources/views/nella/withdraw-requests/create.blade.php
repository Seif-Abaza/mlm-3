@extends('layouts.admin')
@section('content')
    <h3>Create Withdraw Request</h3>
    {!! Form::open(['action' => 'WithdrawRequestsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            <label for="member">Member:</label>
            <select class="form-control" id="member" name="member">
                <option value="">Select Member</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('amount', 'Amount')}}
            {{Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Enter Amount'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
@endsection