@extends('dashboard.master')
@section('content')
    <div class="content-top">
            <div class ="alert alert-info" style="text-align:center;">
                    <p>For successful upload of Student Results, Use the Get Registration List file and do not edit the headings</p>
            </div>
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example">Result Upload for {{$course->title}} ({{$course->code}}) for {{$session->year}}/{{$session->year+1}} SESSION</h3>
                        <form action="{{route('result_upload_action')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="course_id" type="hidden" value="{{$course->id}}">
                            <input name="session_id" type="hidden" value="{{$session->id}}">
                 <div class="form-group">
                   <label for="exampleInputEmail1">Result File</label>
                   <input type="file" class="form-control" name="data_file" required>
                   <center class ="error">{{ $errors->first('data_file') }}</center>
                 </div>

                 <button type="submit" class="btn btn-default">Submit</button>
               </form>
               </div>
        </div>

    </div>
@stop
