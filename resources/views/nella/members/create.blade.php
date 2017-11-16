@extends('layouts.admin')
@section('content')
    <h3>Create New Member</h3>
    {!! Form::open(['action' => 'MembersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('sir_name', 'Surname')}}
            {{Form::text('sir_name', '', ['class' => 'form-control', 'placeholder' => 'Surname'])}}
        </div>
        <div class="form-group">
            {{Form::label('first_name', 'First Name')}}
            {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First Name'])}}
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <select class="form-control" id="country" name="country">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('postal_address', 'Postal Address')}}
            {{Form::textarea('postal_address', '', ['class' => 'form-control', 'placeholder' => 'Postal Address'])}}
        </div>
        <div class="form-group">
            {{Form::label('physical_address', 'Physical Address')}}
            {{Form::textarea('physical_address', '', ['class' => 'form-control', 'placeholder' => 'Physical Address'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone', 'Phone Number')}}
            {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Phone Number'])}}
        </div>
        <div class="form-group">
            {{Form::label('alt_phone', 'Alternative Phone Number')}}
            {{Form::text('alt_phone', '', ['class' => 'form-control', 'placeholder' => 'Alternative Phone Number'])}}
        </div>
        <div class="form-group">
            {{Form::label('id_no', 'ID Number')}}
            {{Form::text('id_no', '', ['class' => 'form-control', 'placeholder' => 'ID Number'])}}
        </div>
        <div class="form-group">
            {{Form::label('id_nin', ' ID NIN')}}
            {{Form::text('id_nin', '', ['class' => 'form-control', 'placeholder' => 'ID NIN'])}}
        </div>
        <div class="form-group">
            {{Form::label('passport', 'Passport Number')}}
            {{Form::text('passport', '', ['class' => 'form-control', 'placeholder' => 'Passport Number'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('dob', 'Date of Birth - (dd/mm/yyyy)')}}
            {{Form::text('dob', '', ['class' => 'form-control', 'placeholder' => 'Enter date of birth - dd/mm/yyyy'])}}
        </div>
    <div class="form-group">
        {{Form::label('neolife_id', 'Neolife ID')}}
        {{Form::text('neolife_id', '', ['class' => 'form-control', 'placeholder' => 'Neolife ID'])}}
    </div>
    <div class="form-group">
        <label for="sponsor">Sponsor:</label>
        <select class="form-control" id="sponsor" name="sponsor">
            <option value="">Select Sponsor</option>
            @foreach($members as $member)
                <option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}} - {{'N/00'.$member->id}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="upline">Upline:</label>
        <select class="form-control" id="upline" name="upline">
            <option value="">Select Upline</option>
            @foreach($members as $member)
                <option value="{{$member->id}}">{{$member->first_name}} {{$member->sir_name}} - {{'N/00'.$member->id}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="shares">Shares:</label>
        <select class="form-control" id="shares" name="shares">
            <option value="">Select Number of Shares</option>
            @foreach([1,3,7] as $share)
                <option value="{{$share}}">{{$share}}</option>v
            @endforeach
        </select>
    </div>
    <div style="border: 1px solid #999;border-radius: 10px;padding: 10px;">
        <div class="form-group">
            <label for="amount">Amount Paid (If Fully Paid):</label>
            <select class="form-control" id="amount" name="amount">
                <option value="">Select Amount Paid</option>
                @foreach([870000,2610000,6090000,10000000] as $amount)
                    <option value="{{$amount}}">{{$amount}}</option>
                @endforeach
            </select>
        </div>
        <div> OR </div>
        <div class="form-group">
            {{Form::label('amount_inst', 'Enter Amount Paid (If In Installments)')}}
            {{Form::text('amount_inst', '', ['class' => 'form-control','id' => 'amount_inst', 'placeholder' => 'Installment - 0 if nothing paid'])}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('paid_at', 'Date of Payment - (dd/mm/yyyy)')}}
        {{Form::text('paid_at', '', ['class' => 'form-control', 'placeholder' => 'Enter date when Member paid - dd/mm/yyyy'])}}
    </div>
    <div class="form-group">
        <label for="pay_time">Payment Interval:</label>
        <select class="form-control" id="pay_time" name="pay_time">
            <option value="">Select Payment Interval</option>
            @foreach([3=>'Weekly', 4=>'Bi-Weekly', 5=>'Monthly'] as $value => $word)
                <option value="{{$value}}">{{$word}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        {{Form::label('nok', 'Next of Kin\'s Name')}}
        {{Form::text('nok', '', ['class' => 'form-control', 'placeholder' => 'Name for Next of kin'])}}
    </div>
    <div class="form-group">
        {{Form::label('nok_phone', 'Next of Kin\'s Phone Number')}}
        {{Form::text('nok_phone', '', ['class' => 'form-control', 'placeholder' => 'Phone number for Next of kin'])}}
    </div>
    <div class="form-group">
        {{Form::label('nok_email', 'Next of Kin\'s email')}}
        {{Form::email('nok_email', '', ['class' => 'form-control', 'placeholder' => 'Email for Next of kin'])}}
    </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
@endsection
@section('footScripts')
    {{--<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>--}}
    {{--<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>--}}
    {{--<script>--}}
        {{--$('textarea').ckeditor();--}}
        {{--// $('.textarea').ckeditor(); // if class is prefered.--}}
    {{--</script>--}}
@endsection