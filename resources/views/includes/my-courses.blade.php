@extends('layouts.app')

@section('title', ' הקורסים שלי   ')

@section('content')

<!-- Start Breadcrumb -->

<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
           <li class="active">הקורסים שלי </li>
        </ul>
      </div>
    </div>
  </div>
</div>


<!-- End Breadcrumb -->
<div class="popular-courses-area coursessection weekly-top-items default-padding bottom-less pt-0" style="direction: rtl;">
  <div class="container">
    <div class="row sidebar-sec">
      <div class="col-md-4">
          @include('includes.profile-sidebar')
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="top-course-items">
            <div class="tabcourses">
                <ul class="nav nav-pills  justify-content-center">
                  <li class="btnglow">
                    <a data-toggle="tab" href="#marathonCorsetab" aria-expanded="false">
                      קורסים במרתון
                    </a>
                  </li>
                  <!--<li>
                    <a data-toggle="tab" href="#chapterCorsetab" aria-expanded="false">
                      פרקים
                    </a>
                  </li>-->
                  <li class="active">
                    <a data-toggle="tab" href="#onlinceCourseTab" aria-expanded="true">
                      קורסים בודדים
                    </a>
                  </li>
                </ul>
            </div>
            <div class="tab-content tab-content-info">
              <div id="onlinceCourseTab" class="tab-pane fade active in">
                <div class="top-course-items">
                  <!-- Single Item -->
                  @if(count($courses_data) > 0)
                      @foreach ($courses_data as $key => $courses)
                          @foreach ($courses as $course)
                              <?php
                              if(isset($course->image)){
                                $image =  asset('/assets/images/' .$course->image);
                              }else{
                                $image =  asset('/assets/img/blank-placeholder.jpg');
                              }
                              ?>
                              <div class="col-md-12 col-sm-12 equal-height eqBox" style="height: 239px;">
                                <div class="item text-right">
                                    <a  href="javascript:void(0);"  data-toggle="modal" class="imgthumb">
                                        <img src="{{ $image }}" alt="Thumb">
                                        {{-- <i class="fa fa-play" aria-hidden="true"></i> --}}
                                    </a>
                                    <div class="info">
                                        <h4>
                                        <a href="{{route('front.mycourse.show',['id' => $course->course_id])}}">{{$course->course_name}}</a>
                                        </h4>
                                        <p>{!! Str::limit($course->description, 150) !!}</p>
                                        <div class="footer-meta">
                                            <ul class="meta-part">
                                                <li class="user">
                                                <i class="fa fa-file"></i>
                                                {{$total_lectures[$key]}} שיעורים
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>                                
                              </div>
                          @endforeach
                      @endforeach
                      <br>
                      <hr style="border: 1px solid #eb871e; background-color: #eb871e;">
                      <p class="text-center">קורסים נוספים שמותאמים עבורך</p> 
                      @if ($courses_data->lastPage() > 1)
                        <ul class="pagination pagMob">
                          <li class="{{ ($courses_data->currentPage() == 1) ? ' disabled' : '' }}">
                            <a href="{{ url()->current().$courses_data->url(1) }}"> קודם  </a>
                          </li>
                          @for ($i = 1; $i <= $courses_data->lastPage(); $i++)
                            <li class="{{ ($courses_data->currentPage() == $i) ? ' active' : '' }}">
                              <a href="{{ url()->current().$courses_data->url($i) }}">{{ $i }}</a>
                            </li>
                          @endfor
                          <li class="{{ ($courses_data->currentPage() == $courses_data->lastPage()) ? ' disabled' : '' }}">   <a href="{{ url()->current().$courses_data->url($courses_data->currentPage()+1) }}" > הַבָּא  </a>
                          </li>
                        </ul>
                      @endif
                  @else
                      <div class="col-md-10">
                          <div class="row" style="margin-top:55px;">
                              <span style="font-size: 25px;">Start Learning From Over Many Courses Today.</span>
                          </div>
                          <div class="row">
                              <span>When you enroll in a course it will appear here.</span>
                          </div>
                      </div>
                  @endif
                  <!-- Single Item -->
                </div>
                <div class="top-course-items">
                  @if(count($userRelatedCourse) > 0)                    
                      @foreach ($userRelatedCourse as $key => $course)                      
                        <?php
                        if(isset($course->image)){
                          $image =  asset('/assets/images/' .$course->image);
                        }else{
                          $image =  asset('/assets/img/blank-placeholder.jpg');
                        }
                        ?>
                        <div class="col-md-12 col-sm-12 equal-height eqBox" style="height: 239px;">
                          <div class="item text-right">
                              <a  href="javascript:void(0);"  data-toggle="modal" class="imgthumb">
                                  <img src="{{ $image }}" alt="Thumb">
                              </a>
                              <div class="info">
                                  <h4>
                                  <a href="{{route('front.mycourse.show',['id' => $course->course_id])}}">{{$course->course_name}}</a>
                                  </h4>
                                  <p>{!! Str::limit($course->description, 150) !!}</p>
                                  <div class="footer-meta">
                                      <ul class="meta-part">
                                          <li class="user">
                                          <i class="fa fa-file"></i>
                                           שיעורים
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>                                         
                        </div>
                      @endforeach                      
                  @endif
                  <!-- Single Item -->
                </div>
              </div>

              <div id="marathonCorsetab" class="tab-pane fade">
              <div class="top-course-items">
                  <!-- Single Item -->
                  @if(count($marathon_data) > 0)
                      @foreach ($marathon_data as $key => $marathon)
                        <?php
                          if(isset($course->image)){
                            $image =  asset('/assets/img/courses/' .$course->image);
                          }else{
                            $image =  asset('/assets/img/blank-placeholder.jpg');
                          }
                        ?>
                        <div class="col-md-12 col-sm-12 eqBox" style="margin-bottom: 30px;">
                            <div class="item text-right">
                                <a  href="#videomodal"  data-toggle="modal" class="imgthumb">
                                    <img src="{{ $image }}" alt="Thumb">
                                    {{-- <i class="fa fa-play" aria-hidden="true"></i> --}}
                                </a>
                                <div class="info">
                                    <h4><a>מרתון עבור {{$marathon->course->course_name}}</a></h4>
                                      <ul>
                                        @if($marathon->course->start_date)
                                            <li>תאריך התחלה - {{ $marathon->course->start_date }}</li>
                                        @endif
                                        @if($marathon->course->start_time &&  $marathon->course->end_time)
                                            <li>זְמַן {{ $marathon->course->start_time }} - {{ $marathon->course->end_time }}</li>
                                        @endif
                                        <div class="footer-meta">
                                          @if( $marathon->course->zoom_link )
                                            <ul class="meta-part">
                                              <li class="user">
                                                  <a href="{{ $marathon->course->zoom_link }}" target="_blank"><i class="fa fa-video"></i> Meeting Link</a>
                                              </li>
                                            </ul>
                                          @endif
                                            <ul class="meta-part">
                                              <li class="user">
                                                  <a href="javascript:void(0);" data-id="{{ $marathon->id }}" class="marathon-upload"><i class="fa fa-upload"></i> Upload Questions</a>
                                              </li>
                                            </ul>
                                          @if( $marathon->course->zoom_record_link )
                                            <ul class="meta-part">
                                              <li class="user">
                                                  <a href="{{ $marathon->course->zoom_record_link }}" target="_blank"><i class="fa fa-video"></i> Record Link</a>
                                              </li>
                                            </ul>
                                          @endif
                                        </div>
                                        <div class="action-response action-res-{{$marathon->id}}">
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                      @endforeach
                      @if ($marathon_data->lastPage() > 1)
                          <ul class="pagination">
                              <li class="{{ ($courses_data->currentPage() == 1) ? ' disabled' : '' }}">
                                  <a href="{{ url()->current().$courses_data->url(1) }}"> קודם  </a>
                              </li>
                              @for ($i = 1; $i <= $marathon_data->lastPage(); $i++)
                                  <li class="{{ ($courses_data->currentPage() == $i) ? ' active' : '' }}">
                                      <a href="{{ url()->current().$courses_data->url($i) }}">{{ $i }}</a>
                                  </li>
                              @endfor
                              <li class="{{ ($courses_data->currentPage() == $courses_data->lastPage()) ? ' disabled' : '' }}">   <a href="{{ url()->current().$courses_data->url($courses_data->currentPage()+1) }}" > הַבָּא  </a>
                              </li>
                          </ul>
                      @endif
                  @else
                      <div class="col-md-10">
                          <div class="row" style="margin-top:55px;">
                              <span style="font-size: 25px;">Start Learning From Over Many Courses Today.</span>
                          </div>
                          <div class="row">
                              <span>When you enroll in a course it will appear here.</span>
                          </div>
                      </div>
                  @endif
                  <!-- Single Item -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 	  <div class="modal videomodal" id="videomodal">
      <div class="modal-dialog">
        <div class="modal-content" style="background:transparent;box-shadow:none;border: none;">
          <!-- Modal body -->
          <div class="modal-body p-0">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <iframe width="100%" height="420" src="https://www.youtube.com/embed/yAoLSRbwxL8?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>

    <div class="modal privatelesson-md marathonModal fade" id="marathonUploadModal">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title"><span><img src="{{asset('assets/img/icon/simulation.png')}}"></span> העלה את המרתון הקשור לשאילתות שלך. </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body  p-30" id="signup">
              <div class="form-wraper w-100 br-all-none p-0">
                <form method="POST" id="uploadMarathonFileForm" action = "" enctype="multipart/form-data">
                  @csrf()
                  <input type="hidden" id="marathonFormId" value=""/>
                  <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                      <div class="fallback">
                        <input name="file" type="file" />
                      </div>
                      <div class="dz-message needsclick">
                        <i class="h3 text-muted dripicons-cloud-upload"></i>
                        <h4>גרור ושחרר קובץ לכאן</h4>
                      </div>
                  </div>
                  <span class="text-danger error-text imageName_err"></span>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-theme btn-md btn-lt-ht mt-20" id="saveMarathonFile">שלח</button>
              <button type="button" class="btn btn-theme btn-md btn-lt-ht mt-20" data-dismiss="modal">לבטל</button>
            </div>
          </div>
      </div>
    </div>
@endsection

@section('scripts')
<script>
  Dropzone.autoDiscover = false;

  $(document).ready(function() {
        var myDropzone = $("div#myAwesomeDropzone").dropzone({
        url: "{{route('front.marathon.questions.store')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        maxFiles: 1,
        acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
        addRemoveLinks: true,
        autoProcessQueue: false,
        removedfile: function(file) {
            var _ref;
             return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        // autoProcessQueue: false,
        init: function() {
            this.on("maxfilesexceeded", function(file){
                this.removeAllFiles();
                this.addFile(file);
            });
            this.on("sending", function(file, xhr, formData){
                formData.append("marathonid", $('#marathonFormId').val());
            });
            var submitButton = document.querySelector('#saveMarathonFile');
            var myDropzone = this;
            submitButton.addEventListener("click", function(){
              if (myDropzone.getQueuedFiles().length > 0) {
                $('.imageName_err').empty();
                myDropzone.processQueue();
              } else {
                $('.imageName_err').html('אנא העלה קובץ.');
              }
            });

        },
        success: function (file, response) {
            var res = JSON.parse(response);
            if(res.status == 1){
                this.removeAllFiles(true);
                var html = '<div class="alert alert-success" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button> Questions uploaded successfully.</div>';
                var id = $('#marathonFormId').val();
                $('.action-res-'+id).html(html);
                $('#marathonUploadModal').modal('hide');
            }
        },
        error: function (file, response) {
          console.log('error');
          console.log(file);
          console.log(response);
          this.removeAllFiles(true);
            return false;
        }
      });
  });
  $('.marathon-upload').on('click', function(e){
    e.preventDefault();
    $('#marathonUploadModal').appendTo("body").modal('show');
    $('#marathonFormId').val($(this).attr('data-id'));
  });
</script>
@endsection
