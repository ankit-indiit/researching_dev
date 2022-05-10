
<!-- Start Navigation -->
<nav class="navbar top-pad navbar-default attr-border-none navbar-fixed navbar-transparent white bootsnav " style="direction:rtl">
  <div class="container">
    <!-- Start Atribute Navigation -->
      <div class="attr-nav">
        <ul>
          @if (Auth::check())
            <?php $count = 0;
              $cart_data = DB::table('cart_items')->where('user_id',Auth::user()->id)->get();
              if(!empty($cart_data)){
                $count = sizeof($cart_data);
              }?>
              <li class="dropdown search shoppingcart">
                <a href="{{route('front.display.cart',['id' => Auth::user()->id,'type' => 0])}}" class="dropdown-toggle" data-toggle="dropdown" ><i class="fas fa-shopping-cart"></i><span class="badge badge-pill badge-danger">{{ $count }}</span></a>
                <?php 
                  if (DB::table('cart_items')->where('user_id',Auth::user()->id)->exists()){?>
                    <ul class="dropdown-menu shopping-cart-items">
                      <h2>עגלת קניות</h2>
                      @php
                        $cartTotal = 0;
                      @endphp
                      @foreach($cart_data as $details)
                      <?php
                        $total = 0; 
                        $total += $details->price * $details->quantity;
                        $cartTotal = $cartTotal + $total; 
                        $viewimage =  asset('/assets/images/' .$details->image); ?>
                          <li class="clearfix">
                            <img src="{{ $viewimage }}">
                            <div class="cartlist">
                              <span class="item-name">{{$details->name}} </span>
                              <span class="item-price">₪{{$details->price}}</span>
                              <!-- <span class="item-quantity">כַּמוּת :                    {{$details->quantity}}</span> -->
                            </div>
                            <div class="align-self-center cart-close">
                              <a  class ="removecart" data-id="{{ $details->course_id }}"><i class="ti-close"></i></a>
                            </div>
                          </li>
                          {{-- <div class="carttotal">
                            <p>סך הכל</p>
                            <h4><b>₪{{$total}}</b></h4>
                          </div> --}}
                        @endforeach
                        <div class="cartbtn">
                          <div class="carttotal">
                            <p>סך הכל</p>
                            <h4><b>₪{{$cartTotal}}</b></h4>
                          </div>                          
                        <a class="btn btn-join effect btn-sm" href="{{route('front.display.cart',['id' => Auth::user()->id,'type' => 0])}}"> צפו בסל   </a>   
                          <!-- <button class="btn btn-join">צפה בסל</button> -->   
                        </div>
                      <?php }?> 
                    @else
                      <?php $count = 0; 
                        // if(Session :: has ('cart') || !empty (Session :: get ('cart'))){
                        // $count = count(session()->get('cart'));
                        // $guestuserid = session()->get('guest_user');
                    // }
                      ?>
                      <li class="dropdown search shoppingcart">
                        <?php if(Session :: has ('cart') || !empty (Session :: get ('cart.items'))){
                          $count = count(session()->get('cart.items'));
                        $guestuserid = session()->get('guest_user');
                          ?>
                        <a href="{{route('front.display.cart',['id' => $guestuserid,'type' => 0])}}" class="dropdown-toggle" data-toggle="dropdown" ><i class="fas fa-shopping-cart"></i><span class="badge badge-pill badge-danger">{{ $count }}</span></a>
                      <?php }else{?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fas fa-shopping-cart"></i><span class="badge badge-pill badge-danger">{{ $count }}</span></a>
                      <?php }?>
                        <?php if(Session :: has ('cart') || !empty (Session :: get ('cart.items'))){
                          $guest_user = session()->get('guest_user');
                          ?>
                        <ul class="dropdown-menu shopping-cart-items">
                          <h2>עגלת קניות</h2>
                          @foreach(session('cart.items') as $id => $details)
                          <?php
                          $total = 0; 
                          $total += $details['price'] * $details['quantity'];
                          $guest_user = session()->get('guest_user');
                          $viewimage =  asset('/assets/img/courses/' .$details['photo']); ?>
                          <li class="clearfix">
                            <img src="{{ $viewimage }}">
                              <div class="cartlist">
                                <span class="item-name">{{$details['name']}} </span>
                                <span class="item-price">₪{{$details['price']}}</span>
                                <span class="item-quantity">כַּמוּת :                    {{$details['quantity']}}</span>
                              </div>
                              <div class="align-self-center cart-close">
                                <a  class ="removecart" data-id="{{ $details['course_id'] }}"><i class="ti-close"></i></a>
                              </div>
                          </li>
                          <div class="carttotal">
                            <p>סך הכל</p>
                            <h4><b>₪{{$total}}</b></h4>
                          </div>
                          @endforeach
                          <div class="cartbtn">
                            <a class="btn btn-join effect btn-sm" href="{{route('front.display.cart',['id' => $guest_user,'type' => 0])}}"> צפו בסל  </a>
                           <!--  <button class="btn btn-join">צפה בסל</button>  -->  
                           </div>
                        </ul>
                        <?php }?>
                     </li>
                    @endif
					  @if (Auth::guest())
						<li class="login"><a href="#loginModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">התחברות / הרשמה</a></li>
					 @endif
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
                        <span> {{ ucfirst(Auth::user()->first_name) }}</span>
                        </a>
                        <ul class="dropdown-menu">

                           <li class="drop-mob-hide">
                            <a href="{{route('front.home')}}"><i class="ti-user"></i>  פּרוֹפִיל </a>
                           </li>
                    
                           <li class="drop-mob-hide">
                              <a href="{{route('front.ticket')}}"><i class="ti-ticket"></i>  הודעות   </a>
                           </li> 
                           <li class="drop-mob-hide">
                              <a href="{{route('front.my-courses')}}"><i class="ti-book"></i>קורסים   </a>
                           </li>
                           <li class="drop-mob-hide">
                              <a href="{{route('front.notifications')}}"><i class="ti-bell"></i>התראות   </a>
                           </li>
                           <li class="drop-mob-hide">
                              <a href="{{route('front.affiliate')}}"><i class="flaticon-group-of-students"></i>שותפים   </a>
                           </li>
                           <li class="">
                              <a  href="{{ route('front.Logout') }}"
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
               <div class="navbar-header" style="float: right;">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
                  <a class="navbar-brand" href="{{url('/')}}"> <img src="{{ asset('/assets/img/logo-light.png') }}" class="logo logo-display" alt="Logo"> <img src="{{ asset('/assets/img/logo-light.png') }}" class="logo logo-scrolled" alt="Logo"> </a>
               </div>
               <!-- End Header Navigation -->
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="navbar-menu">
                 
                  <ul class="nav navbar-nav mx-auto" data-in="fadeInDown" data-out="fadeOutUp">                    
                     <!--li class="active">
                     <a href="courses.html">הקורסים שלי  </a>
                   </li-->
                   <li class="{{ Request::is('/') ? 'active' : '' }}">
                  <a href="{{url('/')}}">
                    בית
                  </a>
               </li>
				      @if(Auth::check())
                <li class="{{ Request::is('courses') ? 'active' : '' }}">
					<a href="{{route('front.my-courses')}}">קורסים   </a>
				</li>
			   @endif
                <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                  <a href="{{url('about-us')}}">  אודות</a>
                </li>
                <li class="{{ Request::is('Blogs') ? 'active' : '' }}">
                  <a href="{{route('front.Blogs')}}">בלוג</a>
                </li>
              
                <li class="{{ Request::is('contact-us') ? 'active' : '' }}">
                   <a href="{{route('front.contact.show')}}">צור קשר </a>
                </li>
                </ul>
                @if(session()->has('successsignup'))
                    <div class="alert alert-success">
                        {{ session()->get('successsignup') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
               </div>
               <!-- /.navbar-collapse -->
            </div>
         </nav>
         <!-- End Navigation -->
@section('scripts')
<script type="text/javascript">
         $(document).ready(function(){
         $(".signuptab").click(function(){
             alert("hello");
          $("ul.nav.nav-pills li").addClass("active");
          $("ul.nav.nav-pills li.logintab").removeClass("active");
          $('#signup1').css({'display': 'inline-block'});
         });
         });  
         var $inputs = $('.input-wraper  .chosen-container.chosen-container-multi').click(function () {
         $inputs.parent().filter('.focus').removeClass('focus');
         $(this).parent().addClass('focus');
      });

      </script>
@endsection