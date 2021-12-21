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
   </head>
   <body>
      <!-- Preloader Start -->
      <div class="se-pre-con"></div>
      <!-- Preloader Ends -->
      <!--Login Popup modal start-->
      <div class="centerflex bgDark ">
         <div class="form-wraper">
            <div class="card">
               <div class="row">
                  <div class="card-body">
                     <div class="after_login " style="direction: rtl;">
                        <h3 class="mb-0">מֵידָע </h3>
                        <form method="POST" id="profile_form" action = "{{ route('front.institute_update') }}" enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="yEWSYthDBW7fWX6J2xn081e2rRJsys6LYrBePraF">                   
                           <span class="text-danger error-text credentials_err"></span> 
                           <?php 
                              $university_data = DB::table('universities')->get();
                              ?>
                           <div class="form-group iconBx selectGen">
                              <select id="profile_university" name="profile_university" class="form-control " data-placeholder="שם האוניברסיטה או המכללה " required="required" >
                                 <option value = "">שם האוניברסיטה או המכללה</option>
                                 @foreach($university_data as $university)
                                 <option value="{{ $university->id }}" {{$university->id == $degree_id  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
                                 @endforeach               
                              </select>
                              <span class="text-danger error-text profile_university_err"></span>
                              <i class="fa fa-building"></i>
                           </div>
                           <div class="form-group iconBx">
                              <?php if((!empty($degree_id)) && (!empty($degree_name))){
                                 ?>
                              <input type="hidden" id="profile_degree_id" value ="{{$degree_id}}">
                              <input type="hidden" id="profile_degree_name" value ="{{$degree_name}}">
                              <?php }else{?>
                              <input type="hidden" id="profile_degree_id" value ="">
                              <input type="hidden" id="profile_degree_name" value ="">
                              <?php }?>
                              <select id = "profile_degree" name = "profile_degree" data-placeholder="תוֹאַר " class="form-control" required="required"  >
                                 <option value="">
                                    אנא בחר את התואר
                                 </option>
                              </select>
                              <span class="text-danger error-text profile_degree_err"></span>
                              <i class="fa fa-graduation-cap"></i>
                           </div>
                           <div class="form-group text-center">
                              <button type="submit" id="loginBtn" class="log-btn form-btn wdt-30"> שלח  </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--Login popup modal end-->
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
      <script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
      <script src="https://dev.indiit.solutions/researching_dev/public/assets/admin/libs/dropzone/min/dropzone.min.js"></script>
      <script type="text/javascript"> 
         var $inputs = $('.input-wraper  .chosen-container.chosen-container-multi').click(function () {
           $inputs.parent().filter('.focus').removeClass('focus');
           $(this).parent().addClass('focus');
         });
         $(document).ready(function(){    
           $("[href^='#']").click(function() {
             id=$(this).attr("href")
             $('html, body').animate({
                 scrollTop: $(id).offset().top
             }, 2000);
           }); 
           var degree_id = $('#profile_degree_id').val();
             var degree_name = $('#profile_degree_name').val();
             $('#profile_degree').append('<option selected value="' + degree_id + '">' + degree_name + '</option>');
           $('#profile_university').change(function(){
               var university_id = $(this).val();
               $.ajax({
                 url: '{{ route('front.getdegree') }}',
                 type: 'POST',
                 data: {
                     university_id: university_id
                 },
                 success: function(data) {
                   $('#profile_degree').html('');
                     $.each(data.degree_data, function(i, d) {
                         $('#profile_degree').append('<option value="' + d.id + '">' + d.degree_name + '</option>');
                     });
                   }
               });
             });
			 
		   $('#profile_university').select2({	   
				closeOnSelect: true ,
		   });			 
         });
      </script>
   </body>
</html>