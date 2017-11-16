@extends('layouts.admin')
@section('content')
    <h3 style="text-align: center">My Team</h3>
    <div style="text-align: center">
        @foreach($my_shares as $key => $array)
            <ul class="list-inline">
                @foreach($array as $share)
                    <li>{{$share->uuid}}</li>
                    {{--@if(strlen($share->uuid) > 2)--}}
                        {{--@if(substr($share->uuid, -1) == 'L')--}}
                            {{--@if(!in_array(substr($share->uuid, 0, -1).'R', $array))--}}
                                {{--<li style="color:red">{{substr($share->uuid, 0, -1).'R'}}</li>--}}
                            {{--@endif--}}
                        {{--@elseif(substr($share->uuid, -1) == 'R')--}}
                            {{--@if(!in_array(substr($share->uuid, 0, -1).'L', $array))--}}
                                {{--<li style="color:red">{{substr($share->uuid, 0, -1).'L'}}</li>--}}
                            {{--@endif--}}
                        {{--@endif--}}
                    {{--@endif--}}
                @endforeach
            </ul>
            <br>
        @endforeach
    </div>

@endsection