@extends('layouts.app')

@section('title', ' אינדקס ')
@section('content')
<div class="banner-inner-area2 pt8"></div>
<div class="front-forgot-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h2 class="text-center">שכחת את הסיסמא? </h2>
                            <p>אתה יכול לאפס את הסיסמה שלך כאן.</p>                        
                        </div>
                        <form  action="{{ route('front.do_forgotpassword') }}" class="mt-4" method="POST" id="second_form">
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
        var token = $("input[name='_token']").val();
		if(email == ''){
			printErrorMsg1('אנא הכנס את הדוא"ל שלך.');
		}else{
			$.ajax({
				url: '{{ route('front.do_forgotpassword') }}',
				type: 'POST',
				dataType: 'json',
				data: {
					email   : email,
					_token  : token
				},
				success: function(data) {
					console.log(data);
					if (data.status == 1) {
						printMsg(data.msg);
					} else {
						printErrorMsg1(data.msg);
					}
				  }
			  });
			}
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