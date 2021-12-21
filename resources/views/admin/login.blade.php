@extends('admin.layouts.app')

@section('title', ' אינדקס ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="login.php" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/assets/admin/images/logo-dark.png') }}" alt="" height="45">
                                            </span>
                                        </a>
                    
                                        <a href="login.php" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{ asset('/assets/admin/images/logo-light.png') }}" alt="" height="22">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">הזן את כתובת הדוא"ל והסיסמה שלך כדי לגשת לחלונית הניהול.</p>
                                </div>
                                <div class="alert alert-danger print-loginerror-msg" style="display:none">
                    <ul></ul>
                  </div>
                                <form  action="{{ route('admin_login') }}" class="mt-4" method="POST" id="first_form">
                                @csrf
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">כתובת דוא"ל</label>
                                        <input id="emailaddress" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="שהכנס את האימייל שלך"">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">סיסמה</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"placeholder="סכנס סיסמתך"">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">זכור אותי</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" id = "loginBtn" class="btn btn-primary btn-block">התחברות </button>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="forgotpassword.php" class="text-white-50 ml-1">שכחת ססמה?</a></p>
                                
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
            
    
      @endsection
      @section('scripts')
      <script type="text/javascript">
           $("#loginBtn").click(function(e) {
          e.preventDefault();
          var email = $("input[name='email']").val();
          var password = $("input[name='password']").val();
          $.ajax({
            url: '{{ route('admin_login') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if (data.status == 1) {
                    window.location.href = '{{ url('/dashboard') }}'
                } else {
                    printErrorMsg1(data.msg);
                }
              }
          });
        });

      function printErrorMsg1 (msg) {
        $(".print-loginerror-msg").find("ul").html('');
        $(".print-loginerror-msg").css('display','block');
        $(".print-loginerror-msg").find("ul").append('<li>'+msg+'</li>');
      }
      </script>
      @endsection