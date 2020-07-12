@extends('dashboard.master')
@section('content')
<div class="content-top">
    <div class="col-md-12">
        <div class="col-md-4">
        <div class="content-top-1">
        <div class="col-md-12 top-content">
            <h5>Students</h5>
            <label>{{$data['students']}}</label>
        </div>
         <div class="clearfix"> </div>
        </div>
        </div>

        <div class="col-md-4">
                <div class="content-top-1">
                <div class="col-md-12 top-content">
                    <h5>Lecturer</h5>
                    <label>{{$data['lecturers']}}</label>
                </div>
                 <div class="clearfix"> </div>
                </div>
                </div>

                <div class="col-md-4">
                        <div class="content-top-1">
                        <div class="col-md-12 top-content">
                            <h5>Courses</h5>
                            <label>{{$data['courses']}}</label>
                        </div>
                         <div class="clearfix"> </div>
                        </div>
                        </div>

    </div>
    <div class="clearfix"> </div>

</div>
@stop
