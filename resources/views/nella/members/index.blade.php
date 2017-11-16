@extends('layouts.admin')
@section('content')
    <h3>Members</h3>
    <a href="{{url('nella/members/create')}}" class="btn btn-success">Add New Member</a>
    <br>
    <br>
    @if(count($members)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Shares</th>
                <th>Balance (UGx)</th>
                <th>Upline</th>
                <th>Sponsor</th>
                <th>Joined</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($members as $member)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td><a href="{{url('nella/members/'.$member->id)}}">{{$member->first_name}} {{$member->sir_name}}</a></td>
                    <td>{{$member->country->name}}</td>
                    <td>{{$member->phone}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->shares}}</td>
                    <td>{{$member->balance}}</td>
                    <td>{{$member->ofUpline->first_name}}</td>
                    <td>{{$member->ofSponsor->first_name}}    </td>
                    <td>{{$member->created_at}}</td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
        {{--{{$members->links()}}--}}
    @else
        <p>No members Available</p>
    @endif
@endsection