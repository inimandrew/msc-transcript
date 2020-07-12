@extends('dashboard.master')
@section('content')
    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Course Registration</h3>
                        <form action="{{route('register_course_action')}}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                 <div class="form-group">
                   <label for="exampleInputEmail1">Course Title</label>
                   <input type="text" class="form-control" name="course_title" required value="{{old('course_title')}}">
                   <center class ="error">{{ $errors->first('course_title') }}</center>
                 </div>
                 <div class="form-group">
                   <label for="exampleInputPassword1">Course Code</label>
                   <input type="text" class="form-control" name="course_code" required value="{{old('course_code')}}">
                   <center class ="error">{{ $errors->first('course_code') }}</center>
                 </div>
                 <div class="form-group">
                        <label for="exampleInputPassword1">Credit Hour</label>
                        <input type="number" class="form-control" name="credit_hour" required value="{{old('credit_hour')}}" min="1" max="20">
                        <center class ="error">{{ $errors->first('credit_hour') }}</center>
                      </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <select class="form-control" name='department_id' required>
                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Programme</label>
                    <select class="form-control" name='programme_id' required>
                        <option value="">Select a Programme...</option>
                        @foreach ($programmes as $programme)
                        <option value="{{$programme->id}}">{{$programme->full_form}} ({{$programme->short_form}})</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Year</label>
                    <select class="form-control" name='year' required>
                        <option value="">Select a Year...</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Semester</label>
                    <select class="form-control" name='semester' required>
                        <option value="">Select a Semester...</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                  </div>
                 <button type="submit" class="btn btn-default">Submit</button>
               </form>
               </div>
        </div>

    </div>
@stop
