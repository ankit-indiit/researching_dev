@extends('admin.auth.layouts.app')

@section('title', ' אינדקס ')
@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{route('admin.adminLogin')}}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/assets/admin/images/logo-dark.png') }}"  alt="" height="45">
                                    </span>
                                </a>
                                <a href="{{route('admin.adminLogin')}}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/assets/admin/images/logo-light.png') }}" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">הזן את כתובת הדוא"ל שלך כדי לשחזר את הסיסמה ששכחת לגשת לחלונית הניהול.</p>
                        </div>
                        <form  action="{{ route('admin.admin_do_forgotpassword') }}" class="mt-4" method="POST" id="second_form">
                        @csrf
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="alert alert-success print-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="form-group mb-3">
                            <label for="emailaddress">כתובת דוא"ל</label>
                                <input class="form-control" type="email" name = "email" id="emailaddress"  placeholder="הכנס את האימייל שלך">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button  id = "forgotBtn"class="btn btn-primary btn-block" type="submit">לאפס את הסיסמה</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p> <a href="{{route('admin.adminLogin')}}" class="text-dark-50 ml-1">חזרה להתחברות</a></p>
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
    $("#forgotBtn").click(function(e) {
        e.preventDefault();
        var email = $("input[name='email']").val();
        $.ajax({
            url: '{{ route('admin.admin_do_forgotpassword') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email
            },
            success: function(data) {
                if (data.status == 1) {
                    printMsg(data.msg);
                } else {
                    printErrorMsg1(data.msg);
                }
              }
          });
        });

    function printErrorMsg1 (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-msg").css('display','none');
        $(".print-error-msg").css('display','block');
        $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
    }
    function printMsg(msg) {
        $(".print-msg").find("ul").html('');
        $(".print-error-msg").css('display','none');
        $(".print-msg").css('display','block');
        $(".print-msg").find("ul").append('<li>'+msg+'</li>');
    }
</script>
@endsection