@extends('admin.layouts.app')

@section('title', ' ערוך קופון ')
@section('content')
<?php 
$is_logged_in = session()->get('admin_logged_in');
        
if(!isset($is_logged_in) && $is_logged_in != '1'){
            
    return redirect()->route('admin.adminLogin')->send();
        }

?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">בית</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.couponslisting')}}">קופונים</a></li>
                                <li class="breadcrumb-item active">ערוך קופון</li>
                            </ol>
                        </div>
                        <h4 class="page-title">ערוך קופון</h4>
                    </div>
                </div>
            </div>
<form method="POST" id="editcoupon_form" action = "" enctype="multipart/form-data">
@csrf()
<input type="hidden" name="coupon_id" id ="coupon_id" value ="{{$coupon_id}}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="direction:rtl">
                    <div class="col-md-6 text-right">
                        <h4 class="header-title mb-3">ערוך קופון</h4>
                    </div>
                    <div class="col-md-6 text-left">
                        <a href="{{route('admin.couponslisting')}}" class="btn btn-primary  mb-3">חזרה לקופונים</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="couponname">שם הקופון</label>   
                                    <input type="text" id="couponname" name ="coupon_name" class="form-control" placeholder="הזן את שם הקופון" value="{{$coupon_data->coupon_name}}">
                                    <span class="text-danger error-text coupon_name_err"></span> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="couponcode">קוד קופון</label>             
                                    <input type="text" id="couponcode" name ="coupon_code" class="form-control" placeholder="הכנס קוד קופון" value="{{$coupon_data->coupon_code}}">
                                    <span class="text-danger error-text coupon_code_err"></span> 
                                </div>
                            </div>
                            <?php if($coupon_data->coupon_type == "1"){?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount">הנחה (%)</label>               
                                    <input type="text" id="discount" name ="coupon_discount" class="form-control" placeholder="הזן הנחה" value="{{$coupon_data->value}}"> 
                                    <span class="text-danger error-text coupon_discount_err"></span>
                                </div>
                            </div>
                            <?php 
                                $university_data = DB::table('universities')->get();
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Instutename">שם מוסד</label>
                                    <select class="form-control" id="instutename" name = "institute_name" placeholder="שם מוסד">
                                    @foreach($university_data as $university)
                                        <option value="{{ $university->university_name }}" {{$university->id == $coupon_data->university_name  ? 'selected' : ''}}>{{ $university->university_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text institute_name_err"></span>
                                </div>
                            </div>
                            <?php 
                                $courses_data = DB::table('courses')->get();
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Courses">קורסים</label>
                                    <select class="form-control" id="Courses" name ="courses" placeholder="קורסים">
                                        @foreach($courses_data as $course_data)
                                        <option value="{{ $course_data->course_name }}" {{$course_data->course_id == $coupon_data->course_name  ? 'selected' : ''}}>{{ $course_data->course_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text courses_err"></span>
                                </div>
                            </div>
                            <?php 
                                $degree_data = DB::table('degrees')->get();
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="degreename">
                                        שם התואר
                                    </label>
                                    <select class="form-control" id="degreename" name = "degree_name" placeholder="שם מוסד">
                                    @foreach($degree_data as $degree)
                                        <option value="{{ $degree->degree_name }}" {{$degree->id == $coupon_data->degree_name  ? 'selected' : ''}}>{{ $degree->degree_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text degree_name_err"></span>
                                </div>
                            </div>
                        <?php }else{?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="discount">הנחה (%)</label>               
                                    <input type="text" id="discount" name ="coupon_discount" class="form-control" placeholder="הזן הנחה" value="{{$coupon_data->value}}">
                                    <span class="text-danger error-text coupon_discount_err"></span> 
                                </div>
                            </div>
                        <?php }?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>תאריך התחלה</label>
                                    <input type="text" class="basic-datepicker form-control" id ="start_date" name = "start_date" placeholder="הזן תאריך התחלה" value="{{$coupon_data->started_at}}">
                                    <span class="text-danger error-text start_date_err"></span>
                                </div>  
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>תאריך תפוגה</label>
                                    <input type="text" class="basic-datepicker form-control" id ="expired_date" name ="expired_date" placeholder="הזן תאריך תפוגה" value="{{$coupon_data->expired_at}}">
                                    <span class="text-danger error-text expired_date_err"></span>
                                </div>
                            </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button id ="editcouponbtn" type="submit" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                                    <button id ="resetcoupon" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div><!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
</form>
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.basic-datepicker ').flatpickr();
        $('#resetcoupon').click(function(){
            window.location.href = '{{route("admin.couponslisting")}}';
        });
      $("#editcouponbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.updatecoupon") }}',
            type: 'POST',
            data:new FormData($("#editcoupon_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.couponslisting")}}';
                } else {
                    printErrorMsg(response.error);
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
        @endsection
        

        