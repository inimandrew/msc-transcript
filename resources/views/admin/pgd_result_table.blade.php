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
    PROGRAMME: PGD IN COMPUTER SCIENCE
</div>

<div>
    DEPARTMENT: COMPUTER SCIENCE
</div>

<div>
    SESSION: {{$year}}/{{$year+1}}
</div>
<div>
    SEMESTER: FIRST/SECOND
</div>
</center>
    <?php $i = 1;
    $multiple = 3;
    $total = 0;
    ?>
    <center>TERMINAL EXAMINATION REPORTING SHEET</center>
    <table style="text-align:center;">
        <tr>
            <th rowspan="3">S/N</th>
            <th rowspan="3">REG. NO/NAME</th>
            <th rowspan="3">STATUS</th>
            <th rowspan="3">PREVIOUSLY FAILED COURSE</th>
            <th rowspan="3">RESIT/REPEAT SUPPLEMENTARY RESULTS</th>
            <th colspan="{{count($first_sem) + count($second_sem)}}">EXAMINATION RESULTS</th>
            <th rowspan="3">G.P.A</th>
            <th rowspan="3">CLASS OF DIPLOMA</th>
            <th rowspan="3">REMARK</th>
        </tr>
        <tr>
            <th colspan="{{count($first_sem)}}">FIRST SEMESTER</th>
            <th colspan="{{count($second_sem)}}">SECOND SEMESTER</th>
        </tr>
        <tr>

            @foreach ($first_sem as $course)
                    <th>{{$course->code}}</th>
                @endforeach

                @foreach ($second_sem as $item)
                <th>{{$item->code}}</th>
                @endforeach
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <td style="text-align:left;">CH</td>
                @foreach ($first_sem as $course)
                    <td>{{$multiple}}</td>
                    <?php $total += $multiple;?>
                @endforeach

                @foreach ($second_sem as $item)
                <td>{{$multiple}}</td>
                <?php $total += $multiple;?>

            @endforeach
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @foreach ($results as $index => $value)
        <tr>
            <?php $sum = 0;?>
            <td>{{$i++}}</td>
            <td>{{strtoupper($index)}}</td>
            <td>FT</td>
            <td></td>
            <td></td>
            @foreach ($value as $student => $grade)

                @foreach ($first_sem as $course)
                    <?php $sum += ($multiple * weight($grade[$course->code]) ); ?>
                        <td>{{$grade[$course->code]}}</td>
                @endforeach

                @foreach ($second_sem as $item)
                <?php $sum = $sum + ($multiple * weight($grade[$item->code]) );?>
                <td>{{$grade[$item->code]}}</td>
            @endforeach
            @endforeach
            <td>{{ sprintf("%.2f",$sum/$total)}}</td>
            <td>CREDIT</td>
            <td>PASS, RECOMMENDED FOR THE AWARD OF PGD IN COMPUTER SCIENCE</td>
        </tr>

        @endforeach
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

