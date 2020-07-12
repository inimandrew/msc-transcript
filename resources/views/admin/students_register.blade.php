@extends('dashboard.master')
@section('content')
    <div class="content-top">
            <div class ="alert alert-info" style="text-align:center;">
                    <center>Download Admission Format <a href="{{route('admission_format')}}" class="btn btn-outline btn-primary btn-sm">Download</a> </center>
                </div>
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Students Registration</h3>
                        <form action="{{route('register_student_action')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }}
                 <div class="form-group">
                   <label for="exampleInputEmail1">Admission Format File</label>
                   <input type="file" class="form-control" name="data_file" required >
                   <center class ="error">{{ $errors->first('data_file') }}</center>
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
                 <button type="submit" class="btn btn-default">Submit</button>
               </form>
               </div>
        </div>

    </div>
@stop
