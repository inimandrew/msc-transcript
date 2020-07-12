<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
       </button>
      <h1> <a class="navbar-brand" disabled>Minimal</a></h1>
      </div>
    <div class=" border-bottom">
   <div class="full-left">
     <section class="full-top">
       <button id="toggle"><i class="fa fa-arrows-alt"></i></button>
   </section>
   <form class=" navbar-left-right">
     <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
     <input type="submit" value="" class="fa fa-search">
   </form>
   <div class="clearfix"> </div>
  </div>


   <!-- Brand and toggle get grouped for better mobile display -->

  <!-- Collect the nav links, forms, and other content for toggling -->
   <div class="drop-men pull-right" >
       <ul class="nav_1">
           <li class="dropdown" >
             <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret">{{Auth::guard('my_users')->user()->firstname}}, {{Auth::guard('my_users')->user()->lastname}}<i class="caret"></i></span><img width="60px" height="60px" src="{{url('dashboard_assets/images/images.png')}}"/></a>
             <ul class="dropdown-menu " role="menu">
               <li><a href="{{route('edit_profile')}}"><i class="fa fa-user"></i>Edit Profile</a></li>
               <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i>Logout</a></li>
             </ul>
           </li>
       </ul>
    </div><!-- /.navbar-collapse -->
   <div class="clearfix">

</div>
@include('dashboard.sidebar')
</nav>
