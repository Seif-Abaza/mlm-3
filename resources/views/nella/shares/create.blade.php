@extends('layouts.admin')
@section('content')
    <h3>Add Share (s)</h3>
    {!! Form::open(['action' => 'SharesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            <label for="member">Member:</label>
            <select class="form-control" id="member" name="member">
                <option value="">Select Member</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}} - {{'N/00'.$member->id}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="shares">Shares to Add:</label>
            <select class="form-control" id="shares" name="shares">
                <option value="">Select Number of Shares (1-7)</option>
                @foreach([1,2,3,4,5,6,7] as $share)
                    <option value="{{$share}}">{{$share}}</option>v
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount Paid:</label>
            <select class="form-control" id="amount" name="amount">
                <option value="">Select Amount Paid</option>
                @foreach([870000,1740000,2610000,3580000,4350000,5220000,6090000] as $amount)
                    <option value="{{$amount}}">{{$amount}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="upline">Share's Upline - (The new share(s) will go under this member):</label>
            <select class="form-control" id="upline" name="upline">
                <option value="">Select Upline</option>
                @foreach($members as $member)
                    <option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}} - {{'N/00'.$member->id}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('paid_at', 'Date of Payment - (dd/mm/yyyy)')}}
            {{Form::text('paid_at', '', ['class' => 'form-control', 'placeholder' => 'Enter date when Member paid - dd/mm/yyyy'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
@endsection