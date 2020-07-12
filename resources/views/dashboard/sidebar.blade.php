<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if (Auth::guard('my_users')->user()->role == '1')
            @if ($session_set == false)
            <li>
                    <a href="{{route('session_scheduler')}}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Begin Session</span> </a>
                </li>
@endif

                <li>
                        <a href="{{route('admin_home')}}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a>
                    </li>
                    @if ($session_set == true)

                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Register</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level"><li><a href="{{route('register_student_page')}}" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Students</a></li>

                        <li><a href="{{route('register_lecturer_page')}}" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Lecturers</a></li>

                       </ul>
                    </li>

                    <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Allocations</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{route('allocate_lecturer_page')}}" class="hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Courses to Lecturers</a></li>
                           </ul>
                        </li>
                        <li>
                            <a href="{{route('end_session')}}" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>End Session</a>
                        </li>

                @endif
                <li>
                    <a href="{{route('register_course_page')}}" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Register Course</a>
                </li>
                <li>
                    <a href="{{route('edit_result')}}" class=" hvr-bounce-to-right"><i class="fa fa-file nav_icon"></i> <span class="nav-label">Edit Result</span></a>
                </li>
                <li>
                    <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Process Transcript</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('pgd_transcript')}}" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>PGD</a></li>
                        <li><a href="{{route('transcript')}}" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>M.Sc/ PHD</a></li>
                       </ul>
                </li>
                <li>
                    <a href="{{route('lecturers_upload')}}" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Results Uploaded</span></a>
                </li>

            @elseif(Auth::guard('my_users')->user()->role == '6')

            <li>
                    <a href="{{route('lecturer_home')}}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a>
                </li>
                @if ($session_set == true)
                <li>
                        <a href="{{route('allocated_courses')}}" class=" hvr-bounce-to-right"><i class="fa fa-anchor nav_icon "></i><span class="nav-label">Allocated Courses</span> </a>
                    </li>
                    @endif

                    <li>
                            <a href="{{route('lecture_history')}}" class=" hvr-bounce-to-right"><i class="fa fa-history nav_icon "></i><span class="nav-label">Lecture History</span> </a>
                        </li>

                        @elseif(Auth::guard('my_users')->user()->role == '7')

                        <li>
                                <a href="{{route('student_home')}}" class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboard</span> </a>
                            </li>
                            @if ($session_set == true)
                            <li>
                                    <a href="{{route('course_registration')}}" class=" hvr-bounce-to-right"><i class="fa fa-anchor nav_icon "></i><span class="nav-label">Course Registration</span> </a>
                                </li>
                                @endif

                                <li>
                                        <a href="{{route('result_page')}}" class=" hvr-bounce-to-right"><i class="fa fa-history nav_icon "></i><span class="nav-label">Results</span> </a>
                                    </li>

            @endif




        </ul>
    </div>
    </div>
