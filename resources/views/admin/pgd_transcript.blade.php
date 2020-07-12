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
                        <h3 id="forms-example" class="">PGD Transcript Process</h3>
                        <form method="POST" autocomplete="off" action="{{route('pgd_transcript_action')}}" >
                                {{ csrf_field() }}
                                <div class="form-group col-md-2">
                                        <label for="">Select a Year</label>
                                </div>
                            <div class="form-group col-md-4">

                                <select name="year" class="form-control" required>
                                    @foreach ($years as $year)
                                        <option value="{{$year['id']}}">{{$year['year']}}/{{$year['year']+1}}</option>
                                    @endforeach
                                </select>
                            </div>


                                    <button  style="margin-left: 15px;" class="btn btn-success" id="submit" name="submit" type="submit">Submit</button>
                                </form>


               </div>
        </div>

        <div class="col-md-12 table-responsive" id="resultpane" style="background:white; margin-top: 10px;">

        </div>

    </div>
@stop
