@extends('dashboard.master')
@section('content')
    <div class="content-top">
        <div class="col-md-12">
                <div class="grid-form1">
                        <h3 id="forms-example" class="">Edit Account Details</h3>
                        <form action="{{route('edit_profile_action')}}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                 <div class="form-row">
                 <div class="form-group col-md-4">
                   <label for="exampleInputEmail1">First-Name</label>
                   <input type="text" class="form-control" id="first_name" name="first_name" required value="{{Auth::guard('my_users')->user()->firstname}}" disabled>
                   <center class ="error">{{ $errors->first('first_name') }}</center>
                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputPassword1">Last-Name</label>
                   <input type="text" class="form-control" id="last_name" name="last_name" required value="{{Auth::guard('my_users')->user()->lastname}}" disabled>
                   <center class ="error">{{ $errors->first('last_name') }}</center>
                 </div>
                 <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Middle-Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" required value="{{Auth::guard('my_users')->user()->middlename}}" disabled>
                    <center class ="error">{{ $errors->first('middle_name') }}</center>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" value="{{Auth::guard('my_users')->user()->email}}" disabled>
                  </div>

                  <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">@if(Auth::guard('my_users')->user()->role == '0') Username
                        @elseif(Auth::guard('my_users')->user()->role == '1') Staff-Id
                    @else Matriculation Number
                @endif</label>
                        <input class="form-control" value="{{Auth::guard('my_users')->user()->identification_number}}" disabled>
                      </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="text" class="form-control" id="new_password" name="new_password" required disabled>
                    <center class ="error">{{ $errors->first('new_password') }}</center>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Confirm New Password</label>
                    <input type="text" class="form-control" id="confirm_new_password" name="confirm_new_password" required disabled>
                    <center class ="error">{{ $errors->first('confirm_new_password') }}</center>
                  </div>

                    <button id="activate" onclick="activateFields()" style="margin-left: 15px;" type="button" class="btn btn-primary">Edit</button>
                    <button type="submit" class="btn btn-success">Submit</button>


                </div>

               </form>
               </div>
        </div>

    </div>
    <script>
        function activateFields(){
            document.getElementById('first_name').disabled = false;
            document.getElementById('last_name').disabled = false;
            document.getElementById('middle_name').disabled = false;
            document.getElementById('new_password').disabled = false;
            document.getElementById('confirm_new_password').disabled = false;
        }
    </script>
@stop
