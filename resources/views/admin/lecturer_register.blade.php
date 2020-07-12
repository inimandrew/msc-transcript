@extends('dashboard.master')
@section('content')
    <div class="content-top">
            <div class ="alert alert-info" style="text-align:center;">
                    <p>For successful upload of Lecturer data, Ensure the excel file contains the following columns in the case they are represented as follows: <span class="error">firstname</span>, <span class="error">lastname </span>, <span class="error">middlename</span>, <span class="error">email </span>, <span class="error">staff_id</span> and <span class="error">rank</span> </p>
                </div>
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Lecturer Registration</h3>
                        <form action="{{route('register_lecturer_action')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }}
                 <div class="form-group">
                   <label for="exampleInputEmail1">Lecturer Data File</label>
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

                 <button type="submit" class="btn btn-default">Submit</button>
               </form>
               </div>
        </div>

    </div>
@stop
