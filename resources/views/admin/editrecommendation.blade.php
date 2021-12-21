@extends('admin.layouts.app')

@section('title', ' עלינו   ')
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
                <li class="breadcrumb-item active">הוסף המלצה</li>
              </ol>
            </div>
            <h4 class="page-title">הוסף המלצה</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">הוסף המלצה</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" id="edit_comment_form" enctype="multipart/form-data">
                @csrf()
                <?php
                if(count($recommendation_data)>0){
                    foreach($recommendation_data as $data){
                        
                ?>
                <input type="hidden" value="{{ $data['id'] }}" name="recommend_id" id="recommend_id">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="user_select">בחר משתמש</label>
                        <?php 
                          $users_data = DB::table('users')->where('status','1')->get();
                        ?>
                        <select id="user_select" name="user_select" class="form-control" data-placeholder="שם האוניברסיטה או המכללה " required="required">
                          <option value="">
                            בחר משתמש
                          </option>
                          @foreach($users_data as $user)
                            <option data-id = "{{ $user->id}}"  data-type = "0" value="{{ $user->id }}" 
                            @if ($data['user_id'] == $user->id)
                                {{'selected="selected"'}}
                            @endif
                            >{{ $user->first_name }}</option>
                        @endforeach   
                        </select>
                        <span class="text-danger error-text user_select_err"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="recommendation_type">
                          הוסף היכן שברצונך להוסיף המלצות
                        </label>
                        <select id="recommendation_type" name="recommendation_type" class="form-control" required="required">
                          <option value="">
                            בחר סוג
                          </option>    
                          <option value="website">
                            אתר אינטרנט
                          </option> 
                          <option value="instructor">
                            מַדְרִיך
                           </option> 
                          <option value="course">
                            קוּרס
                          </option> 
                          <option value="online_recommendation" selected="selected">
                            המלצה מקוונת
                          </option> 
                        </select>
                        <span class="text-danger error-text recommendation_type_err"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group ">
                        <label>
                          בחר תמונה
                        </label>
                        <input style ="border:none;" type='file' id="imageupload" accept=".png, .jpg, .jpeg" name = "avatar" />
                      </div>
                      <span class="text-danger error-text avatar_err"></span>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="recommed">המלצה</label>
                        <textarea type="text" id="recommed" rows="4" name="recommed_desc" class="form-control" placeholder="המלצה">
                            {{$data['description']}}
                        </textarea>
                        <span class="text-danger error-text recommed_desc_err"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="recommed">שורת תגים</label>
                        <input type="text" value="{{ $data['recommed_tag_line'] }}" name="recommed_tag_line" class="form-control" placeholder="שורת תגים" >
                        <span class="text-danger error-text recommed_tag_line_err"></span>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                }
                ?>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <button type="submit" id="editreccmdbtn" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                      <button id="backbtn" type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>

@endsection

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#backbtn').click(function(){
      window.location.href = '{{route("admin.recommendation")}}';
    });

    $('#recommendation_type').change(function(){
      var selected_value = $(this).val();
      if(selected_value == 'course'){
        $('.getcourses').css('display','block');
        $('.getinstructors').css('display','none');
      }else if(selected_value == 'instructor'){
        $('.getcourses').css('display','none');
        $('.getinstructors').css('display','block');
      }else{
        $('.getcourses').css('display','none');
        $('.getinstructors').css('display','none');
      }
    });
        
      $("#editreccmdbtn").click(function(e) {
        e.preventDefault();
        if($('#recommendation_type').val() == 'course' && $('#course_selected').val() == ''){
            $("#errMsg").css("color", "red");
            $("#errMsg").html(" אנא בחר את הקורס   ");
            return 0;
         
        }else if($('#recommendation_type').val() == 'instructor' && $('#instructor_selected').val() == '' ){
            $("#errMsg1").css("color", "red");
            $("#errMsg1").html(" אנא בחר את המדריך  ");
            return 0;
        }else{
          var fd = new FormData();
          var files = $('#imageupload')[0].files;
          if(files.length > 0 ){
            fd.append('file',files[0]);
          }
        $.ajax({
            url: '{{ route("admin.upd_online_recommend") }}',
            type: 'POST',
            data:new FormData($("#edit_comment_form")[0]),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
            success: function(response) {
                 if ($.isEmptyObject(response.error)) {
                    window.location.href = '{{route("admin.recommendation")}}';
                } else {
                    printErrorMsg(response.error);
                }
              }
            });
        }
         
      });
        function printErrorMsg (msg) {
           $.each( msg, function( key, value ) {
              $('.'+key+'_err').text(value);
            });
        }
    });
</script>
@endsection