@extends('dashboard.master')
@section('content')
<link href="{{url('dashboard_assets/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
<style>
.form-group .bootstrap-select.btn-group, .form-horizontal .bootstrap-select.btn-group, .form-inline .bootstrap-select.btn-group {
    border: 1px #d2cbcb solid;
}
</style>
    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Course Allocations</h3>
                        <form method="POST" action="{{route('allocate_lecturer_action')}}"  >
                                {{ csrf_field() }}

                                    <div class="form-group ">
                                            <label for="exampleInputEmail1">Course to be Allocated</label>
                                        <select name="course" class="form-control" required >
                                            <option value="" >Select Course...</option>
                                            @foreach ($courses as $course)
                                             <option value="{{$course->id}}"> {{$course->title}}({{$course->code}})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lecturer(s)</label>
                                    <select id="lecturers" name="lecturers[]" class="selectpicker col-md-12" data-style="form-control" required multiple onchange="display()" >
                                        <option value="">Select Lecturers...</option>

                                            @foreach ($lecturers as $lecturer)
                                            <option  value="{{$lecturer->id}}">{{$lecturer->firstname}}, {{$lecturer->middlename}} {{$lecturer->lastname}}</option>
                                            @endforeach
                                    </select>
                                <center> {{$errors->first('lecturers')}}</center>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Co-ordinating Lecturer</label>
                                <select id="coordinator" name="coordinator" class="form-control"  required >

                                </select>

                                <center> {{$errors->first('coordinator')}}</center>
                            </div>

                                            <div class="form-row">

                                                    <button class="btn btn-success" name="submit" type="submit">Allocate Course</button>

                                    </div>

                                </form>
               </div>
        </div>

    </div>
<script src="{{url('dashboard_assets/bootstrap-select/bootstrap-select.min.js')}}" ></script>
<script>

    function display(){
        var text = $('#lecturers option:selected').toArray();
        var ddA = Array();

        for(var i = 0; i < text.length; i++){
            ddA[text[i].value] = text[i].innerHTML;
        }
        createOption(ddA);
    }

    function createOption(arrayValue){
        $("#coordinator").empty();
        var dd = document.getElementById('coordinator');

        for(let key in arrayValue){
            var option = document.createElement('option');
            option.setAttribute('value',key);
            option.innerHTML = arrayValue[key];
            dd.appendChild(option);
        }
    }
</script>
@stop
