@extends('admin.auth.layouts.app')

@section('title', ' אינדקס ')
@section('content')
<div class="account-pages mt-4 mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{ route('admin.adminLogin') }}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/assets/admin/images/logo-dark.png') }}" alt="" height="45">
                                    </span>
                                </a>
                                <a href="{{ route('admin.adminLogin') }}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/assets/admin/images/logo-light.png') }}" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                        </div>
                        @if($user_id == 0)
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        Invalid page
                    </div>
                </div>
            @else
                <form  action="{{ route('admin.admin_set_password') }}" class="mt-4" method="POST" id="adminLogin">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="alert alert-success print-msg" style="display:none">
                            <ul></ul>
                        </div>
                            <div class="form-group mb-3">
                                <label for="newpassword"> סיסמה חדשה     </label>
                                    <div class="input-group input-group-merge">
                                        <input id="newpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="newpassword"placeholder=" הגדר סיסמה חדשה  ">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                <label for="confirmpassword"> אשר סיסמה   </label>
                                    <div class="input-group input-group-merge">
                                        <input id="confirmpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="confirmpassword"placeholder=" תאשר סיסמא חדשה  ">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" id="resetbtn" class="btn btn-primary btn-block"> לאפס את הסיסמה     </button>
                                </div>
                            </form>
                            @endif
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
        $("#resetbtn").click(function(e) {
        e.preventDefault();
        var password = $("input[name='newpassword']").val();
        var user_id = $("input[name='user_id']").val();
        $.ajax({
            url: '{{ route("admin.admin_set_password") }}',
            type: 'POST',
            dataType: 'json',
            data: {
                newpassword: password,
                user_id :user_id
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