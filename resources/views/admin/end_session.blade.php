@extends('dashboard.master')
@section('content')
    <div class="content-top">

        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">End Session: {{$current_session->year}}/{{$current_session->year+1}}, Semester: {{$current_session->semester}}</h3>
                        <form action="{{route('end_session_action')}}" method="POST" autocomplete="off" >
                            {{ csrf_field() }}
                                <input type="hidden" value="{{$current_session->id}}" name="session_id">

                 <button type="submit" class="btn btn-danger">End Session</button>
               </form>
               </div>
        </div>

    </div>
@stop
