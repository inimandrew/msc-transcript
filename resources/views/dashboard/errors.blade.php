@foreach($errors->all() as $error)

		@if(Session::has('green'))
		<div class ="alert alert-success alert-dismissable" >
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<center>{{$error}}</center>
		</div>
		@elseif(Session::has('red'))
		<div class ="alert alert-danger alert-dismissable" >
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<center>{{$error}}</center>
        </div>
        @elseif(Session::has('yellow'))
        <?php $split = explode(',',$error)?>
            @if($split['0'] == 'success')
		<div class ="alert alert-success alert-dismissable" >
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<center>{{$split[1]}}</center>
        </div>
            @elseif($split['0'] == 'warning')
            <div class ="alert alert-warning alert-dismissable" >
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <center>{{$split[1]}}</center>
            </div>
            @endif
		@endif
	@endforeach
	<?php Session::forget('red'); Session::forget('green');  ?>
