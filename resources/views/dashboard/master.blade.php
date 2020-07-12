@include('dashboard.head')
<style>
.error{
    color:red;
}
</style>
<body>
    <div id="wrapper">

            @include('dashboard.navbar')
            <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 539px;">
                    @if(count($errors) > 0)
                    @include('dashboard.errors')
                @endif
           <div class="content-main">
               @if($session_set == true)
                <div class="banner">

                        <h2>
                        <span>SESSION: {{$session_data->year}}/{{$session_data->year+1}}</span>
                        <i class="fa fa-angle-right"></i>
                        <span>SEMESTER: {{$session_data->semester}}</span>
                        <i class="fa fa-angle-right"></i>
                        <span>DEPARTMENT: {{strtoupper(Auth::guard('my_users')->user()->department->name)}}</span>
                        </h2>
                    </div>
                    @endif
            @yield('content')
            @include('dashboard.footer')
            </div>
            <div class="clearfix"> </div>
           </div>
         </div>

        @include('dashboard.script')
    </body>
    </html>

