@extends('dashboard.master')

@section('content')
<style>
    #resultpane{
        text-align: center;
    }
    table{
        margin-bottom: 15px;
    }
    p {
        margin: 0;
        text-transform: uppercase;
        font-weight: 900;
        font-size: 30px;
    }
    th{
        font-weight: bold;
    }
    .right{
        text-align:right;
    }
    tr{
        text-align: left;
    }

    </style>
    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Transcript Process</h3>
                        <form method="POST" autocomplete="off" class="inline-form" id="show_result">
                                {{ csrf_field() }}

                                <div class="form-group col-md-4">
                                <input  type="text" name="matric_no" id="matric_no" class="form-control" placeholder="Student's Matriculation Number" required>
                            </div>

                                    <button onclick="get_student_result_all()" style="margin-left: 15px;" class="btn btn-success" name="submit" type="button">Submit</button>
                                </form>

                                <form method="POST" action="{{route('msc_transcript_action')}}" autocomplete="off" class="inline-form" id="transcript" style="display:none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="student_id" id="student_id">
                                    <button style="margin-left: 15px;" class="btn btn-primary" name="submit" type="submit">Process Transcript</button>
                                    </form>
               </div>
        </div>


        <div class="col-md-12 table-responsive" id="resultpane" style="background:white; margin-top: 10px;">

        </div>

    </div>
    <script src="{{url('js/result.js')}}"></script>
<script>
    function get_student_result_all(){
        var matric = document.getElementById('matric_no').value;
        var mat = matric.replace(/[//]/g,'-');

        let results = getStudentResults(mat);
        processData(results,'resultpane');

    }

    function checkValue(val){
    }
</script>
@stop
