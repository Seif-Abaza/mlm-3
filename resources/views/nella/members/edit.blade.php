@extends('layouts.admin')
@section('content')
    <h3>Edit Member</h3>
    {!! Form::open(['action' => ['MembersController@update', $member->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('sir_name', 'Surname')}}
        {{Form::text('sir_name', $member->sir_name, ['class' => 'form-control', 'placeholder' => 'Surname'])}}
    </div>
    <div class="form-group">
        {{Form::label('first_name', 'First Name')}}
        {{Form::text('first_name', $member->first_name, ['class' => 'form-control', 'placeholder' => 'First Name'])}}
    </div>
    <div class="form-group">
        <label for="country">Continent:</label>
        <select class="form-control" id="country" name="country">
            <option value="{{$member->country->id}}">{{$member->country->name}}</option>
            @foreach($countries as $country)
                @if($member->country_id != $country->id)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {{Form::label('postal_address', 'Postal Address')}}
        {{Form::textarea('postal_address', $member->postal_address, ['class' => 'form-control', 'placeholder' => 'Postal Address'])}}
    </div>
    <div class="form-group">
        {{Form::label('physical_address', 'Physical Address')}}
        {{Form::textarea('physical_address', $member->physical_address, ['class' => 'form-control', 'placeholder' => 'Physical Address'])}}
    </div>
    <div class="form-group">
        {{Form::label('phone', 'Phone Number')}}
        {{Form::text('phone', $member->phone, ['class' => 'form-control', 'placeholder' => 'Phone Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('alt_phone', 'Alternative Phone Number')}}
        {{Form::text('alt_phone', $member->alt_phone, ['class' => 'form-control', 'placeholder' => 'Alternative Phone Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('id_no', 'ID Number')}}
        {{Form::text('id_no', $member->id_no, ['class' => 'form-control', 'placeholder' => 'ID Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('id_nin', ' ID NIN')}}
        {{Form::text('id_nin', $member->id_nin, ['class' => 'form-control', 'placeholder' => 'ID NIN'])}}
    </div>
    <div class="form-group">
        {{Form::label('passport', 'Passport Number')}}
        {{Form::text('passport', $member->passport, ['class' => 'form-control', 'placeholder' => 'Passport Number'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::email('email', $member->email, ['class' => 'form-control', 'placeholder' => 'Enter Email'])}}
    </div>
    {{--<div class="form-group">--}}
        {{--{{Form::label('dob', 'Date of Birth')}}--}}
        {{--{{Form::date('dob', $member->dob, ['class' => 'form-control', 'placeholder' => $member->dob])}}--}}
    {{--</div>--}}
    <div class="form-group">
        {{Form::label('neolife_id', 'Neolife ID')}}
        {{Form::text('neolife_id', $member->neolife_id, ['class' => 'form-control', 'placeholder' => 'Neolife ID'])}}
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="sponsor">Sponsor:</label>--}}
        {{--<select class="form-control" id="sponsor" name="sponsor">--}}
            {{--<option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}}</option>--}}
            {{--@foreach($members as $sponsor)--}}
                {{--@if($member->sponsor_id != $sponsor->id)--}}
                    {{--<option value="{{$sponsor->id}}">{{$sponsor->first_name}} {{$sponsor->sir_name}}</option>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label for="upline">Upline:</label>--}}
        {{--<select class="form-control" id="upline" name="upline">--}}
            {{--<option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}}</option>--}}
            {{--@foreach($members as $upline)--}}
                {{--@if($member->upline_id != $upline->id)--}}
                    {{--<option value="{{$upline->id}}">{{$upline->first_name}} {{$upline->sir_name}}</option>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<label for="shares">Shares:</label>--}}
        {{--<select class="form-control" id="shares" name="shares">--}}
            {{--<option value="{{$member->shares}}">{{$member->shares}}</option>--}}
            {{--@foreach([1,3,7] as $share)--}}
                {{--@if($member->shares != $share)--}}
                    {{--<option value="{{$share}}">{{$share}}</option>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    <div class="form-group">
        {{Form::label('nok', 'Next of Kin\'s Name')}}
        {{Form::text('nok', $member->nok, ['class' => 'form-control', 'placeholder' => 'Name for Next of kin'])}}
    </div>
    <div class="form-group">
        {{Form::label('nok_phone', 'Next of Kin\'s Phone Number')}}
        {{Form::text('nok_phone', $member->nok_phone, ['class' => 'form-control', 'placeholder' => 'Phone number for Next of kin'])}}
    </div>
    <div class="form-group">
        {{Form::label('nok_email', 'Next of Kin\'s email')}}
        {{Form::email('nok_email', $member->nok_email, ['class' => 'form-control', 'placeholder' => 'Email for Next of kin'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
@endsection