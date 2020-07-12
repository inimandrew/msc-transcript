@extends('dashboard.master')
@section('content')
<?php $gpas = array(); ?>
    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">

                        @if (count($sessions_results) > 0)
                    <?php $i = 0;?>

                        @foreach ($sessions_results as $key )
                        @foreach ($key as $res => $value)
                            <h4>{{$res}}</h4><br>
                    <div class="table-responsive">
                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Assessment Score</th>
                                            <th>Examination Score</th>
                                            <th>Total Score</th>
                                            <th>Grade</th>
                                            <th>Credit Hour</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sum = 0;
                                        $sum_cred = 0;
                                        ?>
                                        @foreach ($value as $result)
                                            <tr>
                                                <td>{{$result->title}}</td>
                                                <td>{{$result->pivot->assessment_score}}</td>
                                                <td>{{$result->pivot->exam_score}}</td>
                                                <td>{{$result->pivot->total_score}}</td>
                                                <td>{{$result->pivot->grade}}</td>
                                                <td>{{$result->credit_hour}}</td>
                                            <?php $sum_cred = $sum_cred + $result->credit_hour;
                                             $mult =  getWeight($result->pivot->grade) * $result->credit_hour;
                                            $sum = $sum + $mult;?>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    </div>
                    @if (count($value) > 0)
                    <?php $gpas[$i] = sprintf('%01.2f',$sum/$sum_cred);?>
                    <div style="background:#f8f8f8; padding:10px 5px;" >GPA: {{$gpas[$i]}}</div>
                    <?php $i++;?>
                    @endif
                    @endforeach

                        @endforeach
               </div>
               @if (count($value) > 0)
               <div style="background:#c9c3c3; padding:10px 5px;" >CGPA: {{sprintf('%01.2f',array_sum($gpas)/count($gpas))}}</div>
               @endif
               @endif


        </div>

    </div>
    <?php
    function getWeight($grade){

    if($grade == 'A'){
        $weight = 5;
    }else if($grade == 'B'){
        $weight = 4;
    }else if($grade == 'C'){
        $weight = 3;
    }else if($grade == 'D'){
        $weight = 2;
    }else if($grade == 'E'){
        $weight = 1;
    }else if($grade == 'F'){
        $weight = 0;
    }
    return $weight;
    }
    ?>
@stop
