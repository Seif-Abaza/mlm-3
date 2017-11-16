@extends('layouts.admin')
@section('content')
    <h3>Payouts - (For this Week)</h3>
    <a href="/nella/payouts/create" class="btn btn-success">Load all Payouts for this week</a>
    <br>
    <br>
    @if(count($final_members)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status/Action</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($final_members as $final_member)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>{{$final_member->first_name.' '.$final_member->sir_name}}</td>
                    <td>{{$final_member->w_payout}}</td>
                    <td>
                        @if($final_member->w_status == 1)
                            <button class="btn btn-success btn-sm">Payment Sent</button>
                        @else
                            {!! Form::open(['action' => ['PayoutsController@update', $final_member->id], 'method' => 'POST']) !!}
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Mark as Sent', ['class' => 'btn btn-sm btn-primary'])}}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
    @else
        <p>No Payouts Available</p>
    @endif
    <hr>
    <h3>Paid <members></members></h3>
    @if(count($paid_members)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Amount</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($paid_members as $paid_member)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>{{$paid_member->first_name.' '.$paid_member->sir_name}}</td>
                    <td>{{$paid_member->p_payout}}</td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
    @else
        <p>No Paid Payouts Available</p>
    @endif
@endsection