@extends('dashboard.master')
@section('content')

<div class="content-top">
    <div class="col-md-12">
        <div class="content-top-1">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered">
                    <tr>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;">Course</th>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;">Lecturers</th>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;">Registered Students</th>
                        <th style="color:black;font-weight:bold;text-transform:uppercase;">Actions</th>
                    </tr>

                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                            <td>{{$course->title}}</td>
                            <td>
                                @foreach($course->lecturers()->where('session_id',$session_data->id)->get() as $lecturer)
                                @if($lecturer->pivot->co_ordinator == '1')
                                <?php $co_ordinate_id = $lecturer->pivot->lecturer_id;?>
                                <p style="color:green">{{$lecturer->firstname}}, {{$lecturer->lastname}} {{$lecturer->middlename}} (Co-ordinator)</p><br>
                                @else
                                <p>{{$lecturer->firstname}}, {{$lecturer->lastname}} {{$lecturer->middlename}}</p><br>
                                @endif
                                @endforeach
                            </td>
                            <td>{{$course->students()->where('session_id',$session_data->id)->count()}}</td>
                            <td>@if($co_ordinate_id == Auth::guard('my_users')->user()->id)
                                <form action="{{route('list')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="course_id" value="{{$course->id}}"/>
                                 <button type="submit" class="btn btn-success">Get Registration List</button>
                                </form> @endif</td>

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
