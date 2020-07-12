@extends('dashboard.master')
@section('content')
    <div class="content-top">

        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Schedule Session</h3>
                        <form action="{{route('session_scheduler_action')}}" method="POST" autocomplete="off" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Session</label>
                                    <select name="year" class="form-control">
                                        <option value="">Select a Session</option>
                                            @for ($i = -1; $i < 3; $i++)
                                                <option value="{{$year}}">{{$year + $i}}/{{$year + $i+1}}</option>
                                            @endfor
                                          </select>
                              </div>
                <div class="form-group">
                          <label for="exampleInputEmail1">Semester</label>
                          <select name="semester" class="form-control">
                                <option value="">Select a Semester ...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                          </select>
                </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Start Date</label>
                   <input type="date" class="form-control" name="date_start" required >
                   <center class ="error">{{ $errors->first('date_start') }}</center>
                 </div>

                 <div class="form-group">
                    <label for="exampleInputEmail1">End Date</label>
                    <input type="date" class="form-control" name="date_end" required >
                    <center class ="error">{{ $errors->first('date_end') }}</center>
                  </div>
                  <div class="form-group">
                        <label for="exampleInputEmail1">Department</label>
                        <select name="department" class="form-control">
                                  @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                  @endforeach
                              </select>
                    <center class ="error">{{ $errors->first('department') }}</center>

                  </div>




                 <button type="submit" class="btn btn-default">Submit</button>
               </form>
               </div>
        </div>

    </div>
@stop
