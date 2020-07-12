<html>
<style>
    div{
        display: inline-block;
        width: 35%;
        padding-bottom: 10px;
        font-weight: bold;
    }
    .down{
        display: inline-block;
        width: 20%;
        padding-bottom: 10px;
        font-weight: bold;
    }
    center{
        margin-top: 25px;
        font-weight: bold;
    }
    table{
        margin-bottom:40px;
    }
    table, th, td {
  border: 2px solid black;
  border-collapse: collapse;
}
    span{
        display: block;
        font-size: 12px;
        padding-bottom: 25px;
    }
    p{
        font-size: 11px;
        padding-bottom: 25px;
    }
</style>
<center>UNIVERSITY OF CALABAR</center>
<center>
<div >
    FACULTY: PHYSICAL SCIENCE
</div>

<div >
    PROGRAMME: M.Sc IN COMPUTER SCIENCE
</div>

<div>
    DEPARTMENT: COMPUTER SCIENCE
</div>

<div>
    SESSION: {{$first_sess}} - {{$second_sess}}
</div>
<div>
    SEMESTER: FIRST/SECOND
</div>
</center>

    <center>TERMINAL EXAMINATION REPORTING SHEET</center>
    <table style="text-align:center;">
        <tr>
            <th >S/N</th>
            <th>REG. NO/NAME</th>
            <th >STATUS</th>
            <th >PREVIOUSLY FAILED COURSE</th>
            <th >RESIT/REPEAT SUPPLEMENTARY RESULTS</th>
            <th colspan="2">FIRST SEMESTER</th>
            <th colspan="2">SECOND SEMESTER</th>
            <th >G.P.A</th>
            <th colspan="3">COMPREHENSIVE PAPERS</th>
            <th rowspan="2">REMARK</th>
        </tr>
        <tr>
            <td rowspan="2">1</td>
            <td rowspan="2">{{$student_name}}</td>
            <td rowspan="2">FT</td>
            <td rowspan="2"></td>
            <td rowspan="2"></td>
            <td colspan="4">{{$first_sess}}</td>
            <td></td>
            <td>I</td>
            <td>II</td>
            <td>III</td>
        </tr>
        <tr>
            <?php $sum = 0;
            $units = 0;
            $cgpa = 0; ?>
                @foreach ($first_year as $results )
                <td colspan="2">
                    @for ($i = 0; $i < count($results); $i++)
                        {{$results[$i]['code']}}  {{$results[$i]['grade']}} <br>
                        <?php $sum += $results[$i]['credit_hour'] * weight($results[$i]['grade']);
                        $units += $results[$i]['credit_hour']; ?>
                    @endfor
                </td>
                @endforeach
                <?php $cgpa += $sum/$units; ?>
            <td>{{sprintf("%.2f",$sum/$units)}}</td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3">PASS  AWAITING EXTERNAL DEFENSE</td>
        </tr>
        <tr>
            <td rowspan="4"></td>
            <td rowspan="4"></td>
            <td rowspan="4"></td>
            <td rowspan="4"></td>
            <td rowspan="4"></td>
            <td colspan="4">{{$second_sess}}</td>
            <td ></td>
        </tr>
        <tr>

            <?php $sum = 0;
            $units = 0; ?>
                @foreach ($second_year as $results )
                <td colspan="2">
                    @if ($results != null)
                    @for ($i = 0; $i < count($results); $i++)
                    {{$results[$i]['code']}}  {{$results[$i]['grade']}} <br>
                    <?php $sum += $results[$i]['credit_hour'] * weight($results[$i]['grade']);
                    $units += $results[$i]['credit_hour']; ?>
                @endfor
                    @endif

                </td>
                @endforeach
                <?php $cgpa += $sum/$units; ?>
            <td>{{sprintf("%.2f",$sum/$units)}}</td>
        </tr>
        <tr>
            <td colspan="4">C.G.P.A</td>
            <td>{{sprintf("%.2f",$cgpa/2)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <center>
        <div class="down">
            DR. E. A. EDIM <span> AG. HOD</span>
            <p>SIGN ...............................</p>
            <p>DATE ...............................</p>
        </div>

        <div class="down">
            DR. (MRS). I. E. ETENG <span> CHAIRMAN, DEPT. GRAD.</span>
            <p>SIGN ...............................</p>
            <p>DATE ...............................</p>
        </div>

        <div class="down">
            DR. B. E. EPHRAIM <span> CHAIRMAN, FAC. GRAD. COMM.</span>
            <p>SIGN ...............................</p>
            <p>DATE ...............................</p>
        </div>

        <div class="down">
            PROF. E. E. OKWUEZE <span> DEAN GRADUATE SCHOOL</span>
            <p>SIGN ...............................</p>
            <p>DATE ...............................</p>
        </div>
    </center>
</html>
<?php
    function weight($grade){
        if($grade == 'A'){
            return 5;
        }elseif ($grade == 'B') {
            return 4;
        }elseif($grade == 'C'){
            return 3;
        }else{
            return 0;
        }
    }
?>

