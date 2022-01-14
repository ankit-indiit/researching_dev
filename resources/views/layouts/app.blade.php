<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>חוקר  - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/flaticon-set.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootsnav.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://dev.indiit.solutions/researching_dev/public/assets/admin/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/summernote.css') }}">
  </head>
  <body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->
    <!-- Header -->
    <header id="home">
      @if(Route::currentRouteName() === 'front.mycourse.show')
        @include('includes.header1')
      @else
        @include('includes.header')
      @endif
    </header>
    <!-- End Header -->
    <main class="py-4">
      @yield('content')
    </main>
    <!-- End content -->
    @if(Route::currentRouteName() === 'front.mycourse.show')
        
      @else
        @include('includes.footer')
      @endif
    @yield('footer')
    <!-- End Footer -->
    <!-- start modal -->
    <div class="modal loginModal loginMOdal" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- modal header -->
          <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <!-- modal header ends -->
          <!-- Modal body -->
          <div class="modal-body">
            <ul class="nav nav-pills" style="display: flex;justify-content: flex-end;">
              <li>
                <a data-toggle="tab" href="#signup1" aria-expanded="false">הירשם</a>
              </li>
              <li class="active logintab">
                <a data-toggle="tab" href="#login1" aria-expanded="true">
                        התחברות
                </a>
              </li>
            </ul>
            <div class="tab-content tab-content-info" style="direction: rtl;">
              <!-- Single Tab -->
              <div id="login1" class="tab-pane fade active in">
                <div class="form-wraper">
                  <h3 class="mb-0">התחבר לחשבונך </h3>
                  <form  action="{{ route('front.loginpage') }}" class="mt-4" method="POST" id="first_form">
                    @csrf
                    <span class="text-danger error-text credentials_err">
                      @if(Session::has('social_errmsg'))
                        {{ Session::get('social_errmsg') }}
                      @endif
                    </span> 
                    <div class="form-group">
                      <input id="email" type="text" class="form-control " name="email" placeholder="שם משתמש או דוא " value="{{ old('email') }}" required autocomplete="email" autofocus multiple>
                      <span class="text-danger error-text email_err"></span>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" type="password" name="" placeholder="סיסמה ">
                      <span class="text-danger error-text password_err"></span>  
                    </div>
                    <div class="form-group checkout-form checkLogin border-0 p-0 mt-0 mb-0">
                      <div class="row  w-100  m-0">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                          <div class="div checkout-form border-0 p-0 mt-0">
                             <span class="checkbox-wrap d-block">
                             <label class="container w-100 mb-0">כלזכור סיסמה
                             <input id = "simulation_terms" type="checkbox" name="simulation_terms" value="">
                             <span class="checkmark"></span>
                             </label>
                             </span>
                          </div>
                        </div>                        
                      </div>                      
                      <span class="checkbox-wrap">                       
                        <div class="row  w-100  m-0">
                          <div class="col-md-6 p-0 ">
                            <p class="text-left mb-0 signup-txt">לא חבר עדיין ? <a  class="signuptab" href="#signup1"  data-toggle="tab" style="color: #eb871e;">הרשם עכשיו </a></p>
                          </div>
                          <div class="col-md-6 passab">
                            <div class="div checkout-form border-0 p-0 mt-0">
                              <span class="checkbox-wrap d-block">
                              @if (Route::has('front.forgotpassword'))
                                <a href="{{ route('front.forgotpassword') }}">
                                  שכחת את הסיסמא ?
                                </a>
                              @endif
                               </span>
                            </div>
                          </div>  
                        </div>
                         
                      </span>

                     
                    </div>

                    <div class="form-group">
                      <button type="submit" id = "loginBtn" class="log-btn form-btn">התחברות </button>
                    </div>
                    <div class="form-group"> <span class="or-txt">
                      <span class="line-span"></span> <span>אוֹ </span> <span class="line-span"></span> </span>
                    </div>
                    <div class="form-group">
                      <button onclick ="location.href ='{{ route('front.facebooklogin') }}'" type="button" class ="form-btn" style="background:#4267b2;font-weight: normal;"><i class="ti-facebook"></i>התחבר עם פייסבוק</button>
                    </div>
                    <div class="form-group">
                      <button onclick ="location.href ='{{ route('front.googlelogin') }}'" type="button" class="form-btn" style="background:#db3236;font-weight: normal;"><i class="fab fa-google" aria-hidden="true"></i>התחבר עם גוגל </button>
                    </div>
                    <div class="form-group mb-0">
                                 <!--  <p class="text-center mb-0 signup-txt">לא חבר עדיין ? <a  class="signuptab" href="#signup"  data-toggle="tab" style="color: #eb871e;">הרשם עכשיו </a></p> -->
                    </div>
                              <!--div class="form-group mb-0">
                                 <p class="text-center mb-0 signup-txt">לא חבר עדיין ? <a href="#" style="color: #eb871e;">הרשם עכשיו </a></p>
                                 </div-->
                  </form>
                </div>
              </div>
              <div id="signup1" class="tab-pane fade">
                <div class="form-wraper">
                  <h3 class="mb-0">הירשם לחשבונך </h3>
                  <form method="POST" action="{{ route('front.signup') }}" id="second_form">
                    @csrf
                    <div class="form-group">
                      <input id="first_name" type="text" class="form-control " name="first_name" placeholder="שם פרטי " value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                      <span class="text-danger error-text first_name_err"></span>
                    </div>
                    <div class="form-group">
                      <input id="last_name" type="text" class="form-control " name="last_name" placeholder="שם משפחה " value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                      <span class="text-danger error-text last_name_err"></span>
                    </div>
                    <div class="form-group">
                      <input id="email1" type="email" class="form-control" name="email1"  placeholder="כתובת דוא " value="{{ old('email1') }}" autocomplete="email1" multiple>
                      <span class="text-danger error-text email1_err"></span>
                    </div>
                    <div class="form-group">
                      <input id="password1" type="password" class="form-control" placeholder="סיסמה "  name="password1">
                      <span class="text-danger error-text password1_err"></span>
                    </div>
                    <?php 
                    $university_data = DB::table('universities')->get();
                    ?>
                    <div class="form-group">
                      <select id="university" name="university" class="form-control" data-placeholder="שם האוניברסיטה או המכללה "  >
                        <option value = "">שם האוניברסיטה או המכללה</option>
                        @foreach($university_data as $university)
                        <option value="{{ $university->id }}">{{ $university->university_name }}</option> 
                        @endforeach               
                      </select>
                      <span class="text-danger error-text university_err"></span>
                    </div>
                    <div class="form-group">
                      <select id = "degree" name = "degree" data-placeholder="תוֹאַר " class="form-control"  >
                        <option value="">וֹאַר </option>        
                      </select>
                      <span class="text-danger error-text degree_err"></span>
                    </div>
                    <div class="form-group checkout-form border-0 p-0 mt-0">
                      <span class="checkbox-wrap d-block">
                        <label class="container w-100 mb-0">כדי להירשם אצלנו אנא סמן כדי להסכים ל   <a href="#" class="terms-text">תנאים והגבלות </a>
                          <input type="checkbox" name="terms" id ="terms" value="">
                          <span class="text-danger error-text terms_err"></span>
                          <span class="checkmark"></span>
                        </label>
                      </span>
                    </div>
                    <div class="form-group">
                      <button id = "signupBtn" type="submit" class="log-btn form-btn">הירשם </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @yield('extra')
    <div class="scroll-to-up">
      <div class="scrollup">
        <i class="fa fa-angle-double-up"></i>
      </div>
    </div>
  <!-- jQuery Frameworks -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/equal-height.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/count-to.js') }}"></script>
    <script src="{{ asset('assets/js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('assets/js/loopcounter.js') }}"></script>
    <!--script src="js/jquery.nice-select.min.js"></script-->
    <script src="{{ asset('assets/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/chosen.jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/prism.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('assets/js/simple-scrollbar.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/sticky-sidebar.js')}}"></script>
    <script src="{{ asset('assets/js/init.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://dev.indiit.solutions/researching_dev/public/assets/admin/libs/dropzone/min/dropzone.min.js"></script>
      <script src="{{ asset('assets/js/summernote.min.js')}}"></script>
      <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
    <script type="text/javascript">

      $(document).ready(function() {
        $('.panel-collapse').on('show.bs.collapse', function() {
        $(this).parent('.panel').find('.fa-minus').show();
        $(this).parent('.panel').find('.fa-plus').hide();
        })
        $('.panel-collapse').on('hide.bs.collapse', function() {
          $(this).parent('.panel').find('.fa-minus').hide();
          $(this).parent('.panel').find('.fa-plus').show();
        })
        $('#terms').change(function() { 
          if ($('#terms').is(":checked") == true) { 
            $('#terms').val('1'); 
          } else { 
            $('#terms').val(''); 
          } 
        });
        $('#university').change(function(){
           var university_id = $(this).val();
           $.ajax({
            url: '{{ route('front.getdegree') }}',
            type: 'POST',
            data: {
                university_id: university_id
            },
            success: function(data) {
              $('#degree').html('');
                $.each(data.degree_data, function(i, d) {
                    $('#degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                });
              }
          });

        });
        $("#loginBtn").click(function(e) {
          e.preventDefault();
          var email = $("input[name='email']").val();
          var password = $("input[name='password']").val();
          $.ajax({
            url: '{{ route('front.loginpage') }}',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    window.location.reload();
                } else {
                    printErrorMsg1(data.error);
                }
              }
          });
        });

      function printErrorMsg1 (msg) {
         $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
      }

      $("#signupBtn").click(function(e) {
        e.preventDefault();
        $('#signup1 .error-text').empty();
        var first_name = $("input[name='first_name']").val();
        var last_name = $("input[name='last_name']").val();
        var email1 = $("input[name='email1']").val();
        var password1 = $("input[name='password1']").val();
        var university = $('#university').val();
        var degree = $('#degree').val();
        var terms = $("input[name='terms']").val();
        var refferel_code = $("input[name='reffere_code_input']").val();
        $.ajax({
            url: '{{ route('front.signup') }}',
            type: 'POST',
            data: {
                first_name:first_name,
                last_name:last_name,
                email1: email1,
                password1: password1,
                university:university,
                degree:degree,
                terms:terms
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                     window.location.reload();
                } else {
                    printErrorMsg(data.error);
                }
            }
        });
    });

    function printErrorMsg (msg) {
      $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
    }
  });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".signuptab").click(function(){
      $("ul.nav.nav-pills li").addClass("active");
      $("ul.nav.nav-pills li.logintab").removeClass("active");
      });
      $(".removecart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url("remove_from_cart") }}',
                    method: "POST",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    });  
    var $inputs = $('.input-wraper  .chosen-container.chosen-container-multi').click(function () {
      $inputs.parent().filter('.focus').removeClass('focus');
      $(this).parent().addClass('focus');
    });
    $(document).ready(function(){    
      // $("[href^='#']").click(function() {
      //   id=$(this).attr("href")
      //   $('html, body').animate({
      //       scrollTop: $(id).offset().top
      //   }, 2000);
      // });    
    });
  </script>
<script>
function init_vid_player(video_link,title,width){
  $('#player').empty();
  $('#player').videre({
      video: {
        quality: [
            {
              src: video_link
            }
        ],
        title: title
      },
      width: width
  });  
}
$(document).ready(function(){
  window.user_id = null;
  $("#forgot_password").click(function(){
    $("#password_form").toggle();
  });
  @if(Session::has('social_errmsg'))
    $('#loginModal').modal('show');
  @endif 

  $('.refferel_code_area input[name=refferel_code]').click(function(){
    if($(this).is(':checked')){
        var reffer_input = '<div class="form-group reffere_code_box"><input type="text" class="form-control reffere_code_input" placeholder="הזן קוד הפניה" name="reffere_code_input"></div>';
        $(this).parent().after(reffer_input);
    }else{
        $('.reffere_code_box').remove();
    }
  }); 
});
</script>
  @yield('scripts')
  </body>
</html>