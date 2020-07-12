@extends('dashboard.master')
<style>
#resultpane{
    text-align: center;
}
</style>
@section('content')

    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Edit Result</h3>
                        <form method="POST" autocomplete="off" id="show_result" >
                                {{ csrf_field() }}
                        <div class="form-row">
                                    <div class="form-group col-md-4 ">
                                            <label for="exampleInputEmail1">Session/Semester course was taken</label>
                                        <select id="sess" name="sess" class="form-control" required >
                                            <option value="" >Select Session/Semester...</option>
                                            @foreach ($sessions as $sess)
                                             <option value="{{$sess->id}}"> {{$sess->year}}/{{$sess->year+1}} Semester: {{$sess->semester}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Select Course</label>
                                    <select id="course_id" name="course_id" class="form-control" required >
                                        <option value="" >Select Course...</option>
                                        @foreach ($courses as $course)
                                         <option value="{{$course->id}}"> {{$course->title}}({{$course->code}})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">Student Matriculation Number</label>
                                <input type="text" name="matric_no" id="matric_no" class="form-control">
                            </div>

                                </div>

                                    <button onclick="getResult()" style="margin-left: 15px;" class="btn btn-success" name="submit" type="button">Submit</button>
                                </form>

                                <form method="POST" autocomplete="off" id="upgrade_result" style="display:none" action="{{route('change_result')}}" >
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-6">
                                    <input type="number" name="assessment_score" id="assessment_score" class="form-control" placeholder="New Assessment Score" required min="0" max="30">
                                </div>

                                    <div class="form-group col-md-6">
                                    <input type="number" name="examination_score" id="examination_score" class="form-control" placeholder="New Examination Score" required min="0" max="70">
                                </div>
                                <input type="hidden" name="result_id" id="result_id" >


                                        <button style="margin-left: 15px;" class="btn btn-success" name="submit" type="submit">Submit</button>
                                    </form>

               </div>
        </div>

        <div class="col-md-12 table-responsive" id="resultpane">

        </div>

    </div>
    <script src="{{url('js/ajax.js')}}"></script>
    <script>

        function getResult() {
            var course = document.getElementById('course_id').value;
            var sess_id = document.getElementById('sess').value;
            var matric = document.getElementById('matric_no').value;
            var mat = matric.replace(/[//]/g,'-');
          let result = getStudentResult(course,sess_id,mat);
          processData(result,'resultpane');
        }
    </script>
@stop
