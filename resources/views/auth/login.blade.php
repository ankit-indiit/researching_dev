@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <!-- Preloader Start -->
      <div class="se-pre-con"></div>
      <!-- Preloader Ends -->

           <!-- Start Breadcrumb 
         ============================================= -->
      <div class="breadcrumb-area shadow dark bg-fixed text-light" style="background-image: url(assets/img/banner/7.jpg);direction: rtl;" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <h1>התחברות </h1>
                  <ul class="breadcrumb">
                     <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li><a href="#">עמודים</a></li>
                     <li class="active">אהתחברות   </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- End Breadcrumb -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="default-padding form-area" style="direction: rtl-;">
         <div class="container">
            <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">
                   Login
           </button> 
            <div class="row">
               <div class="col-md-12">
                  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="form-wraper">
                    <div class="modal-header border-bottom-0">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <h3 class="text-center">התחבר לחשבונך </h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="שם משתמש או דוא " value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-group">
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" name="" placeholder="סיסמה ">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           <i class="ti-eye"></i>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('ור חשבון ') }}
                                    </label>
                                </div>
                                <div >
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('מה אבודה  ?') }}
                                    </a>
                                @endif
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="log-btn form-btn">
                                    {{ __('תחברות ') }}
                            </button>
                        </div>
                        <div class="form-group">
                           <span class="or-txt">
                              <span class="line-span"></span>
                              <span>אוֹ </span>
                              <span class="line-span"></span>
                           </span>
                        </div>
                        <div class="form-group">
                           <button class="form-btn" style="background:#4267b2;font-weight: normal;"><i class="ti-facebook"></i>פייסבוק </button>
                        </div>
                        <div class="form-group">
                           <button class="form-btn" style="background:#db3236;font-weight: normal;"><i class="fa fa-google" aria-hidden="true"></i>גוגל </button>
                        </div>
                        <div class="form-group mb-0">
                          <p class="text-center mb-0 signup-txt">לא חבר עדיין ? <a href="{{ route('register') }}" style="color: #eb871e;">הרשם עכשיו </a></p>
                        </div>
                    </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <a href="#" class="fixed-msg-icon"><img src="assets/img/message-icon.png" alt="Thumb"></a>
      <!-- End Footer -->
            
        </div>
    </div>
@endsection
