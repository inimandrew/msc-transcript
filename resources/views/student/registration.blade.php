@extends('dashboard.master')
@section('content')

<div class="content-top">
    <div class="col-md-12">
        <div class="content-top-1">
        <div class="col-md-12 table-responsive">
            <table class="table">
                    <tr>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;text-align:left;">Course</th>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;text-align:center;">Actions</th>
                    </tr>

                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                            <td>{{$course->title}}({{$course->code}})</td>
                            <td><div class="form-group"><input form="form1" value="{{$course->id}}" type="checkbox" class="form-control" name="courses[]"/> </div> </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><form id="form1" method="POST" action="{{route('registration_action')}}" > {{ csrf_field() }} <button class="btn btn-primary btn-lg col-md-12">Register</button></form></td>
                    </tr>
                </tbody>
            </table>

        </div>
         <div class="clearfix"> </div>
        </div>




    </div>
    <div class="clearfix"> </div>

</div>
@stop
