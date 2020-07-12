@extends('dashboard.master')
        @section('content')
    <?php $stats = array('A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'E' => 0,'F' => 0); ?>
        <div class="content-top">
            <div class="col-md-12">
                <div class="content-top-1">
                    <h3>Results for {{$course->title}} ({{$course->code}}) for {{$session->year}}/{{$session->year+1}}</h3>
                    @if($results->count() > 0)
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered">
                            <tr>
                                <th></th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Matriculation Number</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Name</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Assessment Score</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Examination Score</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Total Score</th>
                                <th style="color:black;font-weight:bold;text-transform:uppercase;">Grade</th>
                            </tr>
                            <?php $i = 1;?>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$result->student->identification_number}}</td>
                                    <td>{{$result->student->firstname}}, {{$result->student->middlename}} {{$result->student->lastname}}</td>
                                    <td>{{$result->assessment_score}}</td>
                                    <td>{{$result->exam_score}}</td>
                                    <td>{{$result->total_score}}</td>
                                    <td>{{$result->grade}}</td>
                                    <?php
                                        switch ($result->grade) {
                                            case 'A':
                                                $stats['A'] = $stats['A'] + 1;
                                                break;

                                            case 'B':
                                            $stats['B'] = $stats['B'] + 1;
                                            break;

                                            case 'C':
                                                $stats['C'] = $stats['C'] + 1;
                                                break;

                                            case 'D':
                                                $stats['D'] = $stats['D'] + 1;
                                                break;

                                            case 'E':
                                            $stats['E'] = $stats['E'] + 1;
                                            break;

                                            default:
                                            $stats['F'] = $stats['F'] + 1;
                                            break;
                                        }
                                    ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                        <h3>Statistics for Results</h3>

                        <table class="table table-bordered">
                            <tbody>
                                    <tr>
                                            <td>Total Registered Students</td>
                                            <td>{{$results->count()}}</td>
                                        </tr>
                               @foreach ($stats as $key => $value )
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                               @endforeach
                               <tr>
                                   <td>Pass %</td>
                                   <td>{{(($stats['A'] + $stats['B'] + $stats['C'] + $stats['D'] + $stats['E'] )/$results->count()) * 100}}</td>
                               </tr>
                               <tr>
                                    <td>Fail %</td>
                                    <td>{{($stats['F']/$results->count()) * 100}}</td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                    @else
                    <div class="col-md-12" style="padding:15px;"><center>No Results have been uploaded yet</center></div>
                    @endif

                 <div class="clearfix"> </div>
                </div>




            </div>
            <div class="clearfix"> </div>

        </div>
        @stop

