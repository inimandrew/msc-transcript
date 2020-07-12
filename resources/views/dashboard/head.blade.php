
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
        @if(Auth::guard('my_users')->user()->role == '1')
        <?php $main = "Administrator" ;?>
        @elseif(Auth::guard('my_users')->user()->role == '6')
        <?php $main = "Lecturer" ;?>
        @elseif(Auth::guard('my_users')->user()->role == '7')
        <?php $main = "Student" ;?>
        @endif
<title>{{$main}} | {{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{url('dashboard_assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />

<link href="{{url('dashboard_assets/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{url('dashboard_assets/css/font-awesome.css')}}" rel="stylesheet">
<script src="{{url('dashboard_assets/js/jquery.min.js')}}"> </script>

<script src="{{url('dashboard_assets/js/bootstrap.min.js')}}"> </script>
<!-- Mainly scripts -->
<script src="{{url('dashboard_assets/js/jquery.metisMenu.js')}}"></script>
<script src="{{url('dashboard_assets/js/jquery.slimscroll.min.js')}}"></script>

<link href="{{url('dashboard_assets/css/custom.css')}}" rel="stylesheet">
<script src="{{url('dashboard_assets/js/custom.js')}}"></script>
<script src="{{url('dashboard_assets/js/screenfull.js')}}"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}



			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});



		});
		</script>


<!--skycons-icons-->

<!--//skycons-icons-->
</head>
