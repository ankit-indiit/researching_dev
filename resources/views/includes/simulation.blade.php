@extends('layouts.app')

@section('title', 'סימולציה')
 
@section('content')
      <!-- Start Breadcrumb 
         ============================================= -->
<style>
    a.disabled {
      pointer-events: none;
      cursor: default;
    }
    .hide{
        display:none;
    }
    .redflag{
        background:red !important;
        margin: 0 !important;
        border-radius: 0px !important;
    }
    .greenflag{
        background:green !important;
        margin: 0 !important;
        border-radius: 0px !important;
    }
    .defaultflag{
        background:#ea9b02;
        margin: 0 !important;
        border-radius: 0px !important;
    }
</style>
    <div class="banner-inner-area2 pt8"></div>
        <div class="breadcrumb-inner-area mb50" style="">
           <div class="container">
              <div class="row">
                 <div class="col-lg-12 col-md-12">
                    <ul class="breadcrumb">
                       <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                       <li><a href="my-course-detail.html">פרט הקורס שלי</a></li>
                       <li class="active">חִידוֹן</li>
                    </ul>
                 </div>
              </div>
           </div>
        </div>


        <!-- 
        <div class="breadcrumb-area" style="" >
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <h1>חִידוֹן</h1>
                  <ul class="breadcrumb">
                     <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
                     <li><a href="my-course-detail.html">פרט הקורס שלי</a></li>
                     <li class="active">חִידוֹן</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="curvedown">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
            <path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
         </svg>
      </div> -->
      
      <div class="course-details-area default-padding pt-0" style="direction: rtl;">
         <div class="container">
            <div class="quiz-header">
               <!--div class="quiz-title">
                  <h1>מבוא למיקרו-כלכלה - המכללה האקדמית ספיר</h1> 
                  <h2>סימולציה</h2></div--> 
               <div class="row mb-20 mt-20">
                  <div class="col-md-4">
                     <div class="quiz-header-actions text-left">
                        <button type="button" id="wtchvideo"  class="wtchvideo btn circle btn-join effect btn-md"><img height="20px" src="{{ asset('/assets/img/viewsolution.png') }}"/> <span>צפה בפתרון
                        </span> 
                        </button>
                        <button type="button" class="startover btn btn-theme "><img height="20px" src="{{ asset('/assets/img/startover.png') }}"/> התחל מחדש </button>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="quiz-title">
                         <h1>
                            <?php 
                            if(!empty($quiz_data) && count($quiz_data) > 0){
                                echo $quiz_data[0]['quizTopic'];                                
                            }
                            ?>
                         </h1>
                        <!--<h1>מבוא למיקרו-כלכלה - המכללה האקדמית ספיר</h1>
-->                     </div>
                     <!--div class="quiz-progress">
                        <div class="quiz-status">
                         <img src="assets/img/status.png"/> 0/18
                        </div> 
                        <div class="quiz-timer"> <img src="assets/img/hourglass.png"/> 00:00
                        </div>
                        
                        </div-->
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div  class="quiz-question-main">
                        <div class="stepsidebar">
                           <ul class="nav nav-tabs questionNumbers" role="tablist">
                                <?php
                                    if(!empty($quiz_questions)){
                                        $quiz_questions1 = $quiz_questions;
                                        $i = 1;
                                        $quiz_questions_chunk = array_chunk($quiz_questions,5);
                                        foreach($quiz_questions_chunk as $five_quest_key=>$five_quest_val){
                                            foreach($five_quest_val as $key=>$val){
                                            if($i>5){
                                                $class  = 'class="hide quest_remove quest_count_'.$five_quest_key.'"';
                                            }else{  
                                                if($i==1){
                                                    $add_active = "active";
                                                }else{
                                                    $add_active = "";
                                                }
                                                $class  = 'class="quest_remove quest_count_'.$five_quest_key.' '.$add_active.'"';
                                                //$class  = 'class="quest_remove quest_count_'.$five_quest_key.'"';
                                            }
                                        ?>
                                            <li <?php echo ($i>5) ? $class :$class; echo ($i==1) ? ' class="active"': ''; ?> >  
                                            <a href="#ques{{$five_quest_key.$key}}" aria-controls="ques{{$five_quest_key.$key}}" role="tab" data-toggle="tab" qestion_id="{{$val['id']}}" class="question_li_cls result_cls{{$val['id']}}">{{$i}}</a></li>    
                                        <?php
                                            $i++;
                                            }
                                        }
                                    }
                                ?>
                              <!--<li  class="active"><a href="#ques1" aria-controls="ques1" role="tab" data-toggle="tab">1</a></li>
                              <li><a href="#ques2" aria-controls="ques2" role="tab" data-toggle="tab">2</a></li>
                              <li><a href="#ques3" aria-controls="ques3" role="tab" data-toggle="tab">3</a></li>
                              <li><a href="#ques4" aria-controls="ques4" role="tab" data-toggle="tab">4</a></li>
                              <li><a href="#ques5" aria-controls="ques5" role="tab" data-toggle="tab">5</a></li>-->
                           </ul>
                        </div>
                        <div  class="quiz-question-container">
                           <div class="stepwizard">
                              <div class="stepwizard-row">
                                <?php
                                    if(!empty($quiz_questions)){
                                        $count = $quiz_questions_count;
                                        $start = 1;
                                        $end = 5;
                                        $oneplus = 1;
                                        for($i=0;$i<=$count;$i++){
                                        $i = $i+5;
                                    ?>
                                    <div class="stepwizard-step">
                                        <a class="btn btn-default btn-circle" href="#step-{{$oneplus}}" data-toggle="tab" data-tab="tabpanel{{$oneplus}}" data-start="{{$start}}" data-end="{{$end}}" onclick="stepnext({{$oneplus}})" >{{$start.'-'.$end}}</a>
                                    </div>
                                    <?php
                                        $start = $end+1;
                                        $end = $end+5;
                                        $i = $i-1;
                                        $oneplus++;
                                        }
                                    }
                                    ?>
                              </div>
                                <div class="tab-content">
                                <?php
                                    if(!empty($quiz_questions1)){
                                    $i=1;
                                    $quiz_questions_chunk = array_chunk($quiz_questions1,5);
                                    foreach($quiz_questions_chunk as $k => $quiz_questions){
                                    $j= $k + 1;
                                ?>
                                <div class="tab-pane  active" id="step-{{$j}}">
                                    <div class="wronganswer">
                                       <div class="tab-content">
                                        <!--********************-->
                                        <?php
                                            foreach($quiz_questions as $key=>$val){
                                            /*echo "<pre>";
                                            print_r($val);
                                            die;*/
                                        ?>
                                            <div role="tabpanel" class="tab-pane tabpanel{{ $k.$key }} <?php echo ($key==0)?'active':'';  ?>" id="ques{{$k.$key}}">
                                            <div class="quiz-question-body">
                                                <div class="question-title">
                                                   <h4><span class="imgquestion"><img src="{{ asset('/assets/img/question-mark.png') }}"/></span>
                                                   שְׁאֵלָה 
                                                   {{ $i }} </h4>
                                                </div>
                                                <div class="question-content">
                                                    <span>
                                                      ? {{ $val['question'] }} 
                                                    <!--איזו מההצהרות הבאות נכונה?
                                                    -->
                                                    </span>
                                                </div>
                                                <div class="question-control">
                                                    <!--h3>בחר את התשובה הנכונה</h3-->
                                                    <?php
                                                        if($val['questionType'] == 1){
                                                    ?>
                                                    <div class="answer-type-choice checkout-form imgquizflex">
                                                      <div class="w20">
                                                        <label for="rdo-1{{ $i }}" class="btn-radio selectedAnswer">
                                                            <input type="radio" id="rdo-1{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                            <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                               <circle cx="10" cy="10" r="9"></circle>
                                                               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                            </svg>
                                                            <span class="checkmark">א</span>
                                                         <img src="{{ asset('/assets/images/') }}/{{$val['optionA']}}" class="quizimg" />
                                                        </label>
                                                        <label for="rdo-2{{ $i }}" class="btn-radio selectedAnswer" >
                                                            <input type="radio" id="rdo-2{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                            <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                               <circle cx="10" cy="10" r="9"></circle>
                                                               <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                            </svg>
                                                            <span class="checkmark">ב </span>
                                                            <img src="{{ asset('/assets/images/') }}/{{$val['optionB']}}" class="quizimg" />
                                                        </label>
                                                        </div>
                                                        <div  class="w20">
                                                            <label for="rdo-3{{ $i }}" class="btn-radio selectedAnswer">
                                                                <input type="radio" id="rdo-3{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                                <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                                <circle cx="10" cy="10" r="9"></circle>
                                                                <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                                </svg>
                                                                <span class="checkmark">ג  </span>
                                                                <!--א  ם יש שיפור טכנולוגי במוצר Y, העלות השולית של מוצר Y תגדל -->
                                                                <img src="{{ asset('/assets/images/')}}/{{$val['optionC']}}" class="quizimg" />
                                                            </label>
                                                            <label for="rdo-4{{ $i }}" class="btn-radio selectedAnswer">
                                                                <input type="radio" id="rdo-4{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                                <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                                <circle cx="10" cy="10" r="9"></circle>
                                                                <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                                </svg>
                                                                <span class="checkmark">ד  </span>
                                                                <img src="{{ asset('/assets/images/')}}/{{$val['optionD']}}" class="quizimg" />
                                                            </label>
                                                        </div>
                                                   </div>
                                                   <?php
                                                    }else{ ?>
                                                    <div class="answer-type-choice checkout-form">
                                                        <label for="rdo-31{{ $i }}" class="btn-radio selectedAnswer" >
                                                         <input type="radio" id="rdo-31{{ $i }}"  name="radio-grp{{ $val['id']}}" class="mcq_answer"  option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                         <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="9"></circle>
                                                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                         </svg>
                                                         <span class="checkmark">א  </span>
                                                         {{ \Illuminate\Support\Str::limit($val['optionA'], 15, $end='') }}
                                                        </label>
                                                        <label for="rdo-32{{ $i }}" class="btn-radio selectedAnswer">
                                                         <input type="radio" id="rdo-32{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                         <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="9"></circle>
                                                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                         </svg>
                                                         <span class="checkmark">ב </span><!--
                                                         כל נקודה על גבי עקומת התמורה יעילה בדיוק באותה המידה.
                                                        -->
                                                        {{ \Illuminate\Support\Str::limit($val['optionB'], 15, $end='') }}
                                                        </label>
                                                        <label for="rdo-33{{ $i }}" class="btn-radio selectedAnswer">
                                                         <input type="radio" id="rdo-33{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                         <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="9"></circle>
                                                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                         </svg>
                                                         <span class="checkmark">ג  </span>
                                                         <!--אם יש שיפור טכנולוגי במוצר Y, העלות השולית של מוצר Y תגדל
                                                        -->
                                                        {{ \Illuminate\Support\Str::limit($val['optionC'], 15, $end='') }}
                                                        </label>
                                                        <label for="rdo-34{{ $i }}" class="btn-radio selectedAnswer">
                                                         <input type="radio" id="rdo-34{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}">
                                                         <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="9"></circle>
                                                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                         </svg>
                                                         <span class="checkmark">ד  </span>
                                                         <!--יש יותר מתשובה אחת נכונה
                                                            -->
                                                            {{ \Illuminate\Support\Str::limit($val['optionD'], 15, $end='') }}
                                                        </label>
                                                    </div>        
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <span class="hide correct{{ $val['id'] }}" style="color:green;font-size:15px;font-weight:600;">התשובה שלך נכונה.</span>
                                                <span class="hide incorrect{{ $val['id'] }}" style="color:red;font-size:15px;font-weight:600;">התשובה שלך לא נכונה.</span>
                                                
                                             </div>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                            <!--<button class="btn circle btn-theme effect" onclick="stepnext(2);" type="button"> שאלה הבאה  <i class="fa fa-chevron-left"></i></button>-->
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                 </div>
                                <?php
                                    }
                                }
                                ?>
                                <!--<button class="btn circle btn-theme effect" onclick="stepnext(2);" type="button"> שאלה הבאה  <i class="fa fa-chevron-left"></i></button>
                                --><div class=" correctanswer mt-30">
                                       <h3 class="mb-0">לא נורא, פעם הבאה  <b>- צפה בסרטון הסבר</b>
                                       </h3>
                                       <br>
                                       <iframe src="https://www.youtube.com/embed/DKz_EEoJRs4?controls=0" width="500" height="270" class="" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="allowfullscreen"></iframe>
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
      <script>
         function stepnext(n){
             if(n != 0){
               //$(".stepwizard-row a").switchClass('btn-primary','btn-default');
                $(".stepwizard-row a").removeClass('btn-primary');
                $(".stepwizard-row a").addClass('btn-default');
                $('.stepwizard a[href="#step-'+n+'"]').tab('show');
                $('.stepwizard-row a[href="#step-'+n+'"]').removeClass('btn-default');
                $('.stepwizard-row a[href="#step-'+n+'"]').addClass('btn-primary');
             }
             n = n -1;
             $(".quest_remove").addClass('hide');
             $(".quest_count_"+n).removeClass('hide');
         }
         stepnext(1);
      </script>
      <script>

        $(document).on("click",".wtchvideo",function(){
            //$('.redAnswer').css('background', 'red');
            //$('.greenAnswer').css('background', 'green');
            var question_id_arr = [];
            var token = $('meta[name=csrf-token]').attr('content');
            $('.question_li_cls').each(function(){
                question_id_arr.push($(this).attr('qestion_id'));
            });
            
            $.ajax({
            url: '{{ route("front.correctAnswerList") }}',
                type: 'POST',
                data: {questionIdArr:question_id_arr,_token:token},
                dataType:'JSON',
                success: function (response) {
                    //console.log(response.data);
                    $.each(response.data, function (key, value) {                     
                        if(value == 1){
                            $(".result_cls"+key).addClass('greenflag');
                        }else if(value == 0){
                            $(".result_cls"+key).addClass('redflag');
                        }else{
                            //$(".result_cls"+key).addClass('defaultflag');
                        }
                    });
                    
                    
                    
                    /*$(response.data).each(function(key,value){
                        if(value == 1){
                            $(".result_cls"+key).addClass('green');
                        }else{
                            $(".result_cls"+key).addClass('red');
                        }
                    });*/
                }
            });
            
            
            
    });
        
        
        $(document).on("click",".mcq_answer",function(){
            let question_id = $(this).attr("question-id");
            let topic_id = $(this).attr("topic_id");
            let choose_option = $(this).attr("option");
            let token = $('meta[name=csrf-token]').attr('content');
            $.ajax({
                    url: '{{ route("front.chooseAnswer") }}',
                    type: 'POST',
                    data: {choose_option:choose_option,question_id:question_id,_token:token,topic_id:topic_id},
                    dataType:'JSON',
                    success: function (response) {
                        if ($.isEmptyObject(response.error)) {
                            if(response.message == 1){
                                $(".correct"+question_id).removeClass('hide');
                                $(".incorrect"+question_id).addClass('hide');
                            }else{
                                
                                $(".incorrect"+question_id).removeClass('hide');
                                $(".correct"+question_id).addClass('hide');
                            }
                		} else {
                    		printErrorMsg(response.error);
                		}
                    }
                });
        });
        
        
        $( window ).load(function() {
            var numItems = $('.question_li_cls').length;
            //console.log(numItems);
        });
                
        $(document).on("click",".question_li_cls",function(){
            var stepval = 1;
            var currentStep = $(this).text();
            //console.log(currentStep);
            if(currentStep <= 5){
              stepnext(1);
            }
            else if(currentStep <= 10){
                stepnext(2);
            }
            else if(currentStep <= 15){
                stepnext(3);
            }else if(currentStep <= 20){
                stepnext(4);
            }
        });
        
        
        //$('ul li:gt(2)').hide();
      </script>
  @endsection