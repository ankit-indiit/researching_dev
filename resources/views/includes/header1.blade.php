<!-- Start Navigation -->
<nav class="navbar top-pad navbar-default attr-border-none  navbar-fixed   white bootsnav" style="direction:rtl">
  <!-- Start Top Search -->
    <!-- <div class="container-fluid"> -->
      <!-- <div class="row"> -->
        <!-- <div class="top-search"> -->
          <!-- <div class="input-group"> -->
            <!-- <form action="#"> -->
              <!-- <input type="text" name="text" class="form-control" placeholder="Search"> -->
                <!-- <button type="submit"> -->
                  <!-- <i class="ti-search"></i> -->
                <!-- </button>   -->
            <!-- </form> -->
          <!-- </div> -->
        <!-- </div> -->
      <!-- </div> -->
    <!-- </div> -->
  <!-- End Top Search -->
<div class="container">
  <!-- Start Atribute Navigation -->
  <div class="attr-nav">
    <ul>
                     <!-- <li class="search"><a href="#"><i class="ti-search"></i></a></li> -->
                      <li class="dropdown search progressdrop">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="progressiveloader" style="
                          @if (userProgress() < 25)
                            border-top: 5px solid #eb871e;
                          @elseif (userProgress() < 50)
                            border-top: 5px solid #eb871e;
                            border-right: 5px solid #eb871e;
                          @elseif (userProgress() < 75)
                            border-top: 5px solid #eb871e;
                            border-right: 5px solid #eb871e;
                            border-bottom: 5px solid #eb871e;
                          @else
                            border-top: 5px solid #eb871e;
                            border-right: 5px solid #eb871e;
                            border-bottom: 5px solid #eb871e;
                            border-left: 5px solid #eb871e;
                          @endif                         
                        ">{{userProgress()}}%</span></a>
                        <ul class="dropdown-menu shopping-cart-items">
                         <li class="clearfix">
                             <a href="javascript:void(0)">שיעורים - 3/15</a>
                           </li>
                           <li class="clearfix">
                             <a href="javascript:void(0)">חידון - 2/10</a>
                           </li>
                           <li class="clearfix">
                             <a href="javascript:void(0)">דגלים - 4</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>

               <div class="loginDrop">
                   @if (Auth::check())
                  <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                    <?php
                     $image =  asset('/assets/users/' .Auth::user()->avatar); 
                  ?>
                     <li class="profile-img dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><img src="{{$image}}" alt="Thumb">
                        <span> {{ ucfirst(Auth::user()->first_name) }} </span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- <li class="">
                              <a href="{{route('front.messages')}}"><i class="ti-email"></i>  הודעות   </a>
                           </li> -->
                           <li class="">
                              <a href="{{route('front.courses')}}"><i class="ti-book"></i>קורסים   </a>
                           </li>
                           <li class="">
                              <a href="{{route('front.notifications')}}"><i class="ti-bell"></i>התראות   </a>
                           </li>
                <li class="">
                              <a href="#"><i class="flaticon-group-of-students"></i>שותפים   </a>
                           </li>
                           <li class="">
                              <a  href="{{ route('front.logout') }}"
                              onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-power-off"></i>
                              להתנתק   </a>
                              <form id="logout-form" action="{{ route('front.logout') }}" method="POST" class="d-none">
                              @csrf
                              </form>
                           </li>
                        </ul>
                     </li>
                     @endif
                    </ul>
               </div>
               <!-- End Atribute Navigation -->
               <!-- Start Header Navigation -->
               <div class="navbar-header" style="    float: right;">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                  <i class="fa fa-bars"></i>
                  </button>
                  <a class="navbar-brand" href="{{ route('front.index') }}">
                    <img src="{{ asset('/assets/img/logo-light.png') }}" class="logo logo-display" alt="Logo">
                    <img src="{{ asset('/assets/img/logo.png') }}" class="logo logo-scrolled" alt="Logo">
                  </a>
               </div>
               <!-- End Header Navigation -->
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="navbar-menu">
              

                    <ul class="nav nav-pills navbar-nav mx-auto playertab"  data-in="fadeInDown" data-out="fadeOutUp">
                           <li class="active">
                              <a data-toggle="tab" href="#tab1" aria-expanded="true">
                 נגן הקורס
                              </a>
                           </li>
						    <li>
                              <a data-toggle="tab" href="#tab2" aria-expanded="false">
                   חומרים ללמידה
                              </a>
                           </li>
                           <li>
                              <a data-toggle="tab" class="tab3 " href="#tab3" aria-expanded="false">
                        אירועים קרובים
                              </a>
                           </li>
                           <!-- <li>
                              <a data-toggle="tab" class="tab4 " href="#tab4" aria-expanded="false">
                      המלצת המשתמש
                              </a>
                           </li> -->
                           <a class=" btn-theme effect btn-md btn-lt-ht recommentbtn" href="#tab4" data-toggle="tab">
                             הוספת המלצה
                           </a>
                        </ul>
               </div>
               <!-- /.navbar-collapse -->
            </div>
         </nav>
         <!-- End Navigation -->