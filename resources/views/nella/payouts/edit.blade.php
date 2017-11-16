@extends('layouts.admin')
@section('content')
    <h3>Edit Withdraw Request</h3>
    {!! Form::open(['action' => ['WithdrawRequestsController@update', $withdraw_request->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <label for="member">Member:</label>
        <select class="form-control" id="member" name="member">
            <option value="{{$withdraw_request->member->id}}">{{$withdraw_request->member->first_name}} {{$withdraw_request->member->sir_name}}</option>
        </select>
    </div>
    <div class="form-group">
        {{Form::label('amount', 'Amount')}}
        {{Form::text('amount', $withdraw_request->amount, ['class' => 'form-control', 'placeholder' => 'Enter Amount'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection