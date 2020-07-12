@extends('dashboard.master')
        @section('content')

        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered">
                            <tr>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Course</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Lecturer</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Year/Semester</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Date Uploaded</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;"></th>
                            </tr>

                        <tbody>
                            @foreach ($uploads as $upload)
                            <tr>
                                <td>{{$upload->course->title}} ({{$upload->course->code}})</td>
                                <td>{{$upload->lecturer->firstname}}, {{$upload->lecturer->lastname}} {{$upload->lecturer->middlename}} </td>
                                <td>{{$upload->session->year}} / {{$upload->session->semester}}</td>
                                <td>{{str_replace(' ',' @ ',$upload->created_at)}}</td>
                                <td><a href="{{route('view_results',[$upload->session->id,$upload->course->id])}}" class="btn btn-success"> View Results</a></td>
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

