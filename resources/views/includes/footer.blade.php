<!-- Start Footer -->

    <footer class="bg-dark text-light<?php  if(Auth::check()){ echo ' mobile_view_menu_cls'; }   ?>" style="direction: rtl;">
      <div class="container">
        <div class="f-items default-padding">
          <div class="row">
            <!-- Single item -->
            <div class="col-md-6 col-sm-6 item equal-height forder1">
              <div class="f-item about">
                <h4>על אודות</h4>
                  <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה </p>
                  <ul>
                    <li>
                      <p> אימייל <span><a href="mailto:info@example.com">info@researching.co.il</a></span></p>
                    </li>
                    <li>
                      <p> כתובת    <span>Paul Samuelson, Rosh HaAyin</span></p>
                    </li>
                  </ul>
                  <img src="{{ asset('assets/img/minlogo.png') }}" class="footlogo" />
              </div>
            </div>
            <!-- End Single item -->
            <!-- Single item -->
            <div class="col-md-3 col-sm-6 item equal-height forder2">
              <div class="f-item link">
                <h4> קטגוריות בלוגים </h4>
                <ul>
                  <li> <a href="#"><i class="ti-angle-left"></i> כלים להצלחה  </a> </li>
                  <li> <a href="#"><i class="ti-angle-left"></i> לְסקה סטטיסטית  </a> </li>
                  <li> <a href="#"><i class="ti-angle-left"></i> חטטיסטיקה מתקדמת  </a> </li>
                  <li> <a href="#"><i class="ti-angle-left"></i> בוא לסטטיסטיקה  </a> </li>
                  <li> <a href="#"><i class="ti-angle-left"></i> מבוא לרז  </a> </li>
                </ul>
              </div>
            </div>
            <!-- End Single item -->
            <!-- Single item -->
            <div class="col-md-3 col-sm-6 item equal-height forder3">
              <div class="f-item link">
                <h4>נראה לאחרונה</h4>
                <!-- <ul>
                  <li> <a href="#"><i class="ti-angle-right"></i> על אודות</a> </li>
                  <li> <a href="#"><i class="ti-angle-right"></i> איש קשר</a> </li>
                  <li> <a href="#"><i class="ti-angle-right"></i> איש קשר</a> </li>
                  <li> <a href="#"><i class="ti-angle-right"></i> שירותים</a> </li>
                  <li> <a href="#"><i class="ti-angle-right"></i> מִקרֶה</a> </li>
                </ul> -->
                <?php
                    //$recently_viewed_content = json_decode(\Cookie::get('recently_viewed_content'), TRUE);
                   // print_r($recently_viewed_content);
                    
                ?>
                @php 
                $recently_viewed_content = json_decode(\Cookie::get('recently_viewed_content'), TRUE);
                @endphp
                @if ( $recently_viewed_content )
                  @php
                    krsort( $recently_viewed_content );
                  @endphp
                      @foreach ( $recently_viewed_content as $rvc)
                    <div class="mainrecentviwelist" onclick="mainrecentviwelist('<?php echo $rvc['url']; ?>')">
                      @isset($rvc['university_name']) {{ $rvc['university_name'] }} @endisset
                    <div class="seenCourse">
                      <img src="{{ asset('assets/images') }}/{{ $rvc['image'] }}" alt="">
                      <div class="seenCourse-body">
                        <a href="{{ $rvc['url'] }}">
                          <p> @isset($rvc['degree']) {{ $rvc['degree'] }} @endisset </p>
                        </a>
                        <a href="{{ $rvc['url'] }}"><h4>{{ $rvc['name'] }}</h4></a>
                        @isset($rvc['cart_url'])
                        <a class="btn-theme btnoutline effect btn-sm cart_button" href="{{ $rvc['cart_url'] }}">הוסף לעגלה  </a>
                        @endisset
                        </div>
                    </div>
                  </div>
                  @endforeach   
				@else
				<div class="seenCourse">
					נראה לאחרונה לא נמצא!
				</div>
                @endif
              </div>
            </div>
            <!-- End Single item -->
          </div>
        </div>
      </div>
      <!-- Start Footer Bottom -->
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p> Copyright <?php echo date("Y");  ?>. All Rights Reserved &copy;</p>
            </div>
            <div class="col-md-6 text-left link">
              <ul>
                <li> <a href="#">מדיניות פרטיות</a> </li>
                <li> <a href="#">תנאים והגבלות</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End Footer Bottom -->
    </footer>
    
    @if (Auth::check())
    <div class="mob-footerfix">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="fixfooter-link">
                        <ul>
                            <li>
                                <a href="{{route('front.home')}}">  פּרוֹפִיל </a>
    						</li>
                            <li>
                                <a href="{{route('front.ticket')}}">הודעות</a>
    						</li>
                            <li>
                                <a href="{{route('front.my-courses')}}">קורסים</a>
    						</li>
                            <li>
                                <a href="{{route('front.notifications')}}">התראות</a>
    						</li>
                            <li>
                                <a href="{{route('front.affiliate')}}">שותפים</a>
    						</li>
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
     @endif
    
    
    <style>
        .mainrecentviwelist{
            cursor:pointer;
        }
    </style>
    <script>
    function mainrecentviwelist(val){
        window.location.href = val;
    }
    </script>