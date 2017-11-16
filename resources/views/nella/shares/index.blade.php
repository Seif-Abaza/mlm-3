@extends('layouts.admin')
@section('content')
    <h3>Shares</h3>
    <a href="/nella/shares/create" class="btn btn-success">Add New Share to Existing member</a>
    <br>
    <br>
    @if(count($shares)>0)
        <table class="table">
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>UUID</th>
                <th>Date</th>
            </tr>
            <?php $c = 1; ?>
            @foreach($shares as $share)
                <tr>
                    <td><?php echo $c; ?></td>
                    <td><a href="/nella/shares/{{$share->id}}">{{$share->id}}</a></td>
                    <td>{{$share->uuid}}</td>
                    <td>{{$share->created_at}}</td>
                </tr>
                <?php $c++; ?>
            @endforeach
        </table>
        {{$shares->links()}}
    @else
        <p>No Shares Available</p>
    @endif
@endsection