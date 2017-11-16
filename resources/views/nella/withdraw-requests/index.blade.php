@extends('layouts.admin')
@section('content')
    <h3>Withdraw Requests</h3>
    <a href="/nella/withdraw-requests/create" class="btn btn-success">Create New Withdraw Request</a>
    <br>
    <br>
    @if(count($withdraw_requests)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($withdraw_requests as $withdraw_request)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td><a href="/nella/withdraw-requests/{{$withdraw_request->id}}">{{$withdraw_request->member->first_name}} {{$withdraw_request->member->sir_name}}</a></td>
                    <td>{{$withdraw_request->amount}}</td>
                    <td>{{$withdraw_request->member->phone}}</td>
                    @if($withdraw_request->status == 0)
                        <td>Rejected</td>
                    @elseif($withdraw_request->status == 1)
                        <td>Paid</td>
                    @elseif($withdraw_request->status == 2)
                        <td>Pending</td>
                    @else
                        <td>n/a</td>
                    @endif
                    <td>{{$withdraw_request->created_at}}</td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
        {{$withdraw_requests->links()}}
    @else
        <p>No Withdraw Requests Available</p>
    @endif
@endsection