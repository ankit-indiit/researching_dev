@extends('admin.layouts.app')

@section('title', ' צור קשר ')
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
                                <li class="breadcrumb-item active">צור קשר</li>
                            </ol>
                        </div>
                        <h4 class="page-title">צור קשר</h4>
                    </div>
                </div>
            </div> 
            <form method="POST" id="contactus_form" action = "{{ route('admin.update_contactus') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3 text-right">צור קשר</h4>
            <?php 
                foreach ($contactus_data as $value) {
                    $id = $value->id;
            ?>
            <input type="hidden" name = 'contact_id' value = "{{$id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="headsub">מידע מוביל</h4>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="phone_title">כותרת הטלפון</label>
                                            <div class="form-group">
                                                <input type="text" id="phone_title" name ="phone_title" class="form-control" placeholder="הזן שם טלפון" value="{{$value->phone_title}}">
                                                <span class="text-danger error-text phone_title_err"></span>
                                            </div>
                                        </div>    
                                        <div class="col-md-6">
                                            <label for="phone_number">מספר טלפון</label>
                                            <div class="form-group">
                                                <input type="tel" id="phone_number" name ="phone_number" class="form-control" placeholder="הזן מספר טלפון" value="{{$value->phone_number}}">
                                                <span class="text-danger error-text phone_number_err"></span>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="address_title">כותרת כתובת</label>
                                            <div class="form-group">
                                                <input type="text" id="address_title" name ="address_title" class="form-control" placeholder="הזן כותרת כתובת" value="{{$value->address_title}}">
                                                <span class="text-danger error-text address_title_err"></span>
                                            </div>
                                        </div>    
                                        <div class="col-md-6">
                                            <label for="address_details">פרטי כתובת</label>
                                            <div class="form-group">
                                                <input type="tel" id="address_details" name ="address_details" class="form-control" placeholder="הזן פרטי כתובת" value="{{$value->address_details}}">
                                                <span class="text-danger error-text address_details_err"></span>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="email_title">כותרת דואר</label>
                                            <div class="form-group">
                                                <input type="text" id="email_title" name ="email_title" class="form-control" placeholder="הזן כותרת למייל" value="{{$value->email_title}}">
                                                <span class="text-danger error-text email_title_err"></span>
                                            </div>
                                        </div>    
                                        <div class="col-md-6">
                                            <label for="email_details">פרטי דואר</label>
                                            <div class="form-group">
                                                <input type="tel" id="email_details" name ="email_details" class="form-control" placeholder="הזן פרטי מייל" value="{{$value->email_details}}">
                                                <span class="text-danger error-text email_details_err"></span>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="social_title">חֶברָתִי</label>
                                            <div class="form-group">
                                                <input type="text" id="social_title" name="social_title" class="form-control" placeholder="הזן כותרת חברתית" value="{{$value->social_title}}">
                                                <span class="text-danger error-text social_title_err"></span>
                                            </div>
                                        </div>    
                                        <div class="col-md-6">
                                            <label for="social_instagram">אינסטגרם</label>
                                            <div class="form-group">
                                                <input type="tel" id="social_instagram" name="social_instagram" class="form-control" placeholder="כנסו לקישור לאינסטגרם" value="{{$value->social_instagram}}">
                                                <span class="text-danger error-text social_instagram_err"></span>
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <label for="social_youtube">יוטיוב</label>
                                            <div class="form-group">
                                                <input type="tel" id="social_youtube" name="social_youtube" class="form-control" placeholder="הכנס קישור ליוטיו" value="{{$value->social_youtube}}">
                                                <span class="text-danger error-text social_youtube_err"></span>
                                            </div>
                                        </div>      
                                        <div class="col-md-6">
                                            <label for="social_facebook">פייסבוק</label>
                                            <div class="form-group">
                                                <input type="tel" id="social_facebook" name="social_facebook" class="form-control" placeholder="הכנס לקישור בפייסבוק" value="{{$value->social_facebook}}">
                                                <span class="text-danger error-text social_facebook_err"></span>
                                            </div>
                                        </div>                                                                                                                                                                
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <h4 class="headsub">שאלות ותשובות</h4>
                                </div>             
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="que_ans_title">כותרת</label>
                                        <input type="text" id="que_ans_title" name="que_ans_title" class="form-control" placeholder="הזן כותרת" value="{{$value->que_ans_title}}">
                                        <span class="text-danger error-text que_ans_title_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="que_ans_desc">תיאור</label>
                                        <textarea type="text" id="que_ans_desc" name="que_ans_desc" class="form-control" placeholder="הזן תיאור">{{$value->que_ans_desc}}</textarea>
                                        <span class="text-danger error-text que_ans_desc_err"></span>
                                    </div>
                                </div>                                                                                                                                                                                       
                                <div class="col-md-12">
                                    <h4 class="headsub">מידע אחר</h4>
                                </div>     
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address1">כתובת 1</label>
                                        <input type="text" id="address1" name="address1" class="form-control" placeholder="הכנס כתובת" value="{{$value->address1}}">
                                        <span class="text-danger error-text address1_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address2">כתובת 2</label>
                                        <input type="text" id="address2"  name = "address2" class="form-control" placeholder="הכנס כתובת" value="{{$value->address2}}">
                                        <span class="text-danger error-text address2_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude1">קו אורך 1</label>
                                        <input type="text" id="longitude1" name ="longitude1" class="form-control" placeholder="הזן קו אורך" value="{{$value->longitude1}}">
                                        <span class="text-danger error-text longitude1_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude1">קו רוחב 1</label>
                                        <input type="text" id="latitude1" name = "latitude1" class="form-control" placeholder="היכנס לרוחב" value="{{$value->lattitude1}}">
                                        <span class="text-danger error-text latitude1_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude2">קו אורך 2</label>
                                        <input type="text" id="longitude2" name = "longitude2" class="form-control" placeholder="הזן קו אורך" value="{{$value->longitude2}}">
                                        <span class="text-danger error-text longitude2_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude2">קו רוחב 2</label>
                                        <input type="text" id="latitude2" name = "latitude2" class="form-control" placeholder="היכנס לרוחב" value="{{$value->lattitude2}}">
                                        <span class="text-danger error-text latitude2_err"></span>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <button type="submit" id ="contactbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                                    <button id = "contact_reset" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->
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
       $('#contact_reset').click(function(){
      window.location.href = '{{route("admin.dashboard")}}';
    });
        $("#contactbtn").click(function(e) {
        e.preventDefault();
         var fd = new FormData();
        $.ajax({
            url: '{{ route("admin.update_contactus") }}',
            type: 'POST',
            data:new FormData($("#contactus_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                if ($.isEmptyObject(response.error)) {
                    window.location.reload();
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