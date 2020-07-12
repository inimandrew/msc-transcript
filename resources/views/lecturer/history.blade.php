@extends('dashboard.master')
        @section('content')

        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered">
                            <tr>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Course</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Year/Semester</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Actions</th>
                            </tr>

                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                    <td>{{$course->courses->title}}</td>
                                    <td>{{$course->session_taught->year}}/{{$course->session_taught->semester}}</td>
                                    <td>@if ($course->co_ordinator == '1')
                                        <a href="{{route('result_upload',[$course->session_id,$course->courses->id])}}" style="margin-bottom:5px;" class="btn btn-primary">Upload Results</a>
                                        <form action="{{route('list')}}" method="POST" >
                                            {{ csrf_field() }}
                                            <input type="hidden" name="course_id" value="{{$course->courses->id}}">
                                            <input type="hidden" name="session_id" value="{{$course->session_id}}">
                                        <button style="margin-bottom:5px;" type="submit" class="btn btn-success">Get Registration List</button>
                                    </form>
                                    @endif
                                    <a href='{{route('view_results',[$course->session_id,$course->courses->id])}}' class="btn btn-default">View Results</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                 <div class="clearfix"> </div>
                </div>




            </div>
            <div class="clearfix"> </div>

        </div>
        @stop

