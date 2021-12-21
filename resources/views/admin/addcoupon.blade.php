@extends('admin.layouts.app')

@section('title', ' הוסף קופון ')
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
                                <li class="breadcrumb-item active">הוסף קופון</li>
                            </ol>
                        </div>
                        <h4 class="page-title">הוסף קופון</h4>
                    </div>
                </div>
            </div> 
<form method="POST" id = "add_coupon_form" action="{{ route('admin.savecoupon') }}" enctype="multipart/form-data">
    @csrf()
    <input type="hidden" id = "custom_check" name="custom_check" value ="1">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="direction:rtl">
                        <div class="col-md-6 text-right">
                            <h4 class="header-title mb-3">הוסף קופון</h4>
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
                                        <input type="text" id="add_coupon_name" name ="add_coupon_name" class="form-control" placeholder="הזן את שם הקופון" value="">
                                        <span class="text-danger error-text add_coupon_name_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="couponcode">קוד קופון</label>                 
                                        <input type="text" id="add_couponcode" name= "add_couponcode" class="form-control" placeholder="הכנס קוד קופון" > 
                                        <span class="text-danger error-text add_couponcode_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="discount">הנחה (%)</label>                     
                                        <input type="text" id="add_discount" name = "add_discount" class="form-control" placeholder="הזן הנחה" > 
                                        <span class="text-danger error-text add_discount_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group totaldiscount">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input totaldiscount-check" onchange="valueChanged()" id="customCheck1" name = "customCheck1">
                                            <span class="text-danger error-text customCheck1_err"></span>
                                            <label class="custom-control-label" for="customCheck1">הנחה כוללת באתר</label>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $university_data = DB::table('universities')->get();
                            ?>
                            <div class="col-md-6 showcourse-inst">
                                <div class="form-group">
                                    <label for="Instutename">שם מוסד</label>
                                    <select class="form-control" id="instutename" name = "institute_name" placeholder="שם מוסד">
                                        <option selected value=""> בבקשה תבחר</option>
                                    @foreach($university_data as $university)
                                        <option value="{{ $university->id }}">{{ $university->university_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text institute_name_err"></span>
                                </div>
                            </div>
                              <?php 
                                $courses_data = DB::table('courses')->get();
                            ?>
                            <div class="col-md-6 showcourse-inst">
                                <div class="form-group">
                                    <label for="Courses">קורסים</label>
                                    <select class="form-control" id="Courses" name ="courses" placeholder="קורסים">
                                        <option selected value="">
                                            בבקשה תבחר
                                        </option>
                                        @foreach($courses_data as $course_data)
                                        <option value="{{ $course_data->course_id }}">{{ $course_data->course_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text courses_err"></span>
                                </div>
                            </div>
                            <?php 
                                $degree_data = DB::table('degrees')->get();
                            ?>
                            <div class="col-md-6 showcourse-inst">
                                <div class="form-group">
                                    <label for="degreename">
                                        שם התואר
                                    </label>
                                    <select class="form-control" id="degreename" name = "degree_name" placeholder="שם מוסד">
                                        <option selected value="">
                                            בבקשה תבחר
                                        </option>
                                    @foreach($degree_data as $degree)
                                        <option value="{{ $degree->id }}" >{{ $degree->degree_name }}</option> 
                                    @endforeach               
                                    </select>
                                    <span class="text-danger error-text degree_name_err"></span>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>תאריך התחלה</label>
                                <input type="text" class="basic-datepicker form-control" id ="start_date" name = "start_date" placeholder="הזן תאריך התחלה" value="">
                                <span class="text-danger error-text start_date_err"></span>
                            </div>  
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>תאריך תפוגה</label>
                                <input type="text" class="basic-datepicker form-control" id ="expired_date" name ="expired_date" placeholder="הזן תאריך תפוגה" value="">
                                <span class="text-danger error-text expired_date_err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" id="savecouponbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                            <button id = "resetadd" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
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
function valueChanged()
        {
            if($('.totaldiscount-check').is(":checked")){
                $('#custom_check').val('0');
                $('#instutename').val('');
                $('#Courses').val('');
                $('#degreename').val('');
                $(".showcourse-inst").hide();
            }else{
                $('#custom_check').val('1');
                $(".showcourse-inst").show();
            }
        }
    $(document).ready(function() {
        
        $('.basic-datepicker ').flatpickr();
        $('#resetadd').click(function(){
            window.location.href = '{{route("admin.couponslisting")}}';
        });

      
      $("#savecouponbtn").click(function(e) {
        e.preventDefault();
         
        $.ajax({
            url: '{{ route("admin.savecoupon") }}',
            type: 'POST',
            data:new FormData($("#add_coupon_form")[0]),
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