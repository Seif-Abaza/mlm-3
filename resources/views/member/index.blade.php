@extends('layouts.member')
@section('content')
    <div class="row" style="background-color: #fff;padding: 10px 5px;">
        <div class="col-md-4">
            <div  style="border: 1px solid #999;padding: 5px;border-radius: 10px;">
                <h3>Balance <small>{{$member->first_name.' '.$member->sir_name}}</small></h3>
                <h2>Ugx. {{$member->balance}}</h2>
            </div>
        </div>
        <div class="col-md-8">
            <div  style="border: 1px solid #999;padding: 5px;border-radius: 10px;">
                <h3>My Team</h3>
                    @if(count(App\Member::downlines($member->id))>0)
                        <ol>
                            @foreach(App\Member::downlines($member->id) as $downline)
                                <li><b>{{$downline->sir_name.' '.$downline->first_name}}</b></li>
                                @if(count(App\Member::downlines($downline->id))>0)
                                    @foreach(App\Member::downlines($downline->id) as $downline1)
                                        <li>{{$downline1->sir_name.' '.$downline1->first_name}}</li>
                                        @if(count(App\Member::downlines($downline1->id))>0)
                                            @foreach(App\Member::downlines($downline1->id) as $downline2)
                                                <li>{{$downline2->sir_name.' '.$downline2->first_name}}</li>
                                            @endforeach
                                            <br>
                                        @endif
                                    @endforeach
                                    <br>
                                @endif
                            @endforeach
                        </ol>
                    @else
                        <p>You haven't created a team yet!</p>
                    @endif
            </div>
        </div>
    </div>
@endsection