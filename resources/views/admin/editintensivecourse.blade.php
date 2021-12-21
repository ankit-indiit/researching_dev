@extends('admin.layouts.app')

@section('title', 'קורס מרתון - עריכה')
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
                <li class="breadcrumb-item"><a href="javascript: void(0);">
                  מוצרים
                </a></li>
                <li class="breadcrumb-item active">
                  ערוך מוצר
                </li>
              </ol>
            </div>
            <h4 class="page-title">
              ערוך מוצר
            </h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box" >
          	<div class="row" >
		          <div class="col-md-6 text-left">
                <a href="{{route('admin.Productslisting').'/'.$degree_id.'/'.$university_id}}" class="btn btn-primary  mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  חזרה למוצרים
                </font></font></a>
			 </div>
			</div>
            <div class="row" style="direction:rtl">
              <div class="col-md-12">
              	<div class="courses-sections-details">
				
					<div id="edit_course" class="tabcontent2" style="display: block;">
						<h3>
        ערוך קורס      
            </h3>
      <div class="row" style="direction:rtl">
      <div class="col-md-6 text-right">
        <h4 class="header-title mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ערוך מוצר</font></font></h4>
      </div>
    </div>
  <form method="POST" id = "edit_intensivecourse_form" enctype="multipart/form-data">
    <input type="hidden" name="intensive_course_id" id="course_id" value="{{$course_id}}">
    @csrf()
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
        <?php 
        $university_data = DB::table('universities')->get();
        ?>
          <div class="col-md-6">
      <div class="form-group">
        <label for="Instutename">שם מוסד</label>
            @foreach($university_data as $university)
              @if ($university_id == $university->id)
              <input type="text" class="form-control" name="edit_university" value="{{ $university->university_name }}" readonly/>
              @endif
            @endforeach  
          <span class="text-danger error-text edit_university_err"></span>
      </div>
    </div>
    <?php 
      $degrees_data = DB::table('degrees')->get();
    ?>
     <div class="col-md-6">
        <div class="form-group">
          <label for="degree">תוֹאַר</label>
              @foreach($degrees_data as $degree)
                @if ($degree_id == $degree->id)
                <input type="text" class="form-control" name="edit_degree" value="{{  $degree->degree_name }}" readonly/>
                @endif
              @endforeach               
            <span class="text-danger error-text edit_degree_err"></span>
          </div>
        </div>
          <?php 
          $instructors_data = DB::table('instructors')->get();
        ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="instructorname">מַדְרִיך</label>
              <select id="edit_instructor" name="edit_instructor" class="form-control" data-placeholder="שם האוניברסיטה או המכללה<" required="required" >
                <option value = "">שם האוניברסיטה או המכללה</option>
                @foreach($instructors_data as $instructor)
                  <option <?php if ($intensive_course->instructor_id == $instructor->id) echo ' selected="selected"'; ?> value="{{ $instructor->id }}">{{ $instructor->first_name . $instructor->last_name }}</option> 
                @endforeach               
              </select>
              <span class="text-danger error-text add_instructor_err"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="cname">שם קורס</label>
          <input type="text" id="edit_course_name" name="edit_course_name" value="{{$intensive_course->course_name}}" class="form-control" placeholder="הזן את שם הקורס">
          <span class="text-danger error-text edit_course_name_err"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="url">
                      כתובת אתר כמובן
          </label>
          <input type="text" name ="edit_course_url" id="edit_course_url" value="{{$intensive_course->video_link}}" class="form-control" placeholder="הזן את כתובת האתר של סרטון הקורס">
          <span class="text-danger error-text edit_course_url_err"></span>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="cname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">תאריך התחלה</font></font></label>
          <input type="date" id="course_date" name="course_date" value ="{{$intensive_course->start_date}}" class="form-control">
          <span class="text-danger error-text course_date_err"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="cname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">שעת התחלה</font></font></label>
          <input type="time" id="course_start_time" name="course_start_time" value ="{{$intensive_course->start_time}}" class="form-control changeStartDate" placeholder="HH:MM">
          <span class="text-danger error-text course_start_time_err"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="cname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">שעת סיום</font></font></label>
          <input type="time" id="course_end_time" name="course_end_time" value ="{{$intensive_course->end_time}}" class="form-control changeEndDate" placeholder="HH:MM">
          <span class="text-danger error-text course_end_time_err"></span>
        </div>
      </div>
      <?php 
        $topics = DB::table('topics')->where('course_id',$course_id)->get();
        $get_topics = explode(',',$intensive_course->topics);
      ?>
      <div class="col-md-12">
        <div class="form-group">
          <label for="course_topics">נושאים</label>
              <select id="edit_course_topics" name="edit_course_topics[]" class="form-control chosen-select" data-placeholder="שם האוניברסיטה או המכללה<" required="required" multiple = 'multiple'>
                <option value = "">בחר את הנושאים שיילמדו</option>
                @foreach($topics as $topic)
                  <option  <?php echo in_array($topic->id, $get_topics) ? ' selected="selected"' : ' '; ?> value="{{ $topic->id }}">{{ $topic->topic_name }}</option> 
                @endforeach               
              </select>
              <span class="text-danger error-text edit_course_topics_err"></span>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-lg-12">
          <label for="zoom_url"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                  קישור לפגישה זום
          </font></font></label>
          <input type="text" id="zoom_url" name="zoom_url" class="form-control" placeholder="הזן קישור לפגישת זום" value="{{$intensive_course->zoom_link}}">
          <span class="text-danger error-text zoom_url_err"></span>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group col-lg-12">
          <label for="url"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
              מחיר
          </font></font></label>
          <input type="text" id="edit_price" name="edit_price" class="form-control" placeholder="" value="{{$intensive_course->marathon_price}}">
          <span class="text-danger error-text edit_price_err"></span>
        </div>
      </div> 
    </div>
    <div class="row mt-3">
      <div class="col-12 text-center">
        <button type="submit" id="edit_intensive_product" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> לִשְׁלוֹחַ</font></font></button>
        <button type="button" id="bckbtn" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">לְבַטֵל</font></font></button>
      </div>
    </div>
  </div>
</div> <!-- end card-->
</form>
</div>
</div>
</div>
</div>
</div> 
</div>
</div>
</div>
</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  Dropzone.autoDiscover = false;
  $(document).ready(function() {
    $('#backbtn').click(function(){
      window.location.href = '{{route("admin.Productslisting")."/".$degree_id."/".$university_id}}';
    });
  
    $("#edit_intensive_product").click(function(e) {
        $('.error-text').empty();
        e.preventDefault();
          var fd = new FormData();
        $.ajax({
          url: '{{ route("admin.updateintensiveproduct") }}',
          type: 'POST',
          data:new FormData($("#edit_intensivecourse_form")[0]),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
          success: function(response) {
            if ($.isEmptyObject(response.error)) {
                window.location.href = '{{route("admin.Productslisting")."/".$degree_id."/".$university_id}}';
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
    $('.changeStartDate').on('change', function() {
      if($(this).val()){
        var ct = $(this).val().split(":");
        var newHour =   parseInt(ct[0]) + 4;
        switch(newHour) {
          case 24:
            newHour = 00;
            break;
          case 25:
            newHour = 01;
            break;
          case 26:
            newHour = 02;
            break;
          case 27:
            newHour = 03;
            break;
          case 28:
            newHour = 04;
            break;
          default:
            newHour = newHour;     
        }
        ct[0] = ('0' + newHour).slice(-2);
        var newtime = ct.join(':');
        $('.changeEndDate').val(newtime);
      }else{
        $('.changeEndDate').val($(this).val());
      }
    });
  });
   
</script>
@endsection