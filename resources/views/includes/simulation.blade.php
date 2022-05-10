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
   .path.outer.roundcolor{
   stroke:#2da51f;
   }
   .stepwizard .btn-primary {
   width: auto;
   }
   .btn.active, .btn:active {
    background-image: none !important;
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

<div class="main-covz">
   <div class="container">
     <div class="quiz-title">
            <h1>
                @if(!empty($quiz_data) && count($quiz_data) > 0)
                    {{ $quiz_data['quiz_title'] }}
                @endif
            </h1>                     
       </div>
      <div class="row" style="height: 100%;">
         <div class="col-lg-9" style="height: 100%;">
            @php
                if (!empty($quiz_questions)) {
                    $quiz_questions1 = $quiz_questions;
                }   
            @endphp
            @if(!empty($quiz_questions1))
            @php
                $lastElement = end($quiz_questions1);
                $countquestion = count($quiz_questions1);
          
                $i=1;
                $countingquestion=0;
                $quiz_questions_chunk = array_chunk($quiz_questions1,5);
            @endphp 
            @foreach($quiz_questions_chunk as $k => $quiz_questions)
                @php
                    $j= $k + 1;
                @endphp
                <div class="tab-content">
                    @foreach($quiz_questions as $key=>$val)
                    @php
                        if ($key == 0) {
                            $class = 'active';
                        } else {
                            $class = '';
                        }
                    @endphp
                    
                    <div class="tab-pane {{$class}}" dataid="{{ $val['id'] }}" class="viewSolution questionMainDiv{{ @$val['id'] }} tab-pane tabpanel{{ $k.$key }} <?php echo ($key==0)?'active':'';  ?>" id="ques{{$k.$key}}">
                    <a href="#showAllAns" role="tab" data-toggle="tab" class="btn btn-them my-btn">צפה בפתרון כל השאלות</a>
                        <div class="ques-cov">
                            {{-- <div class="ques-nam">{{ $val['question'] }}</div> --}}
                            <div class="ques-option">                        
                              <div class=""><b>{{ $val['question'] }}</b></div>           
                                    <?php
                                    if($val['questionType'] == 1){
                                    ?>
                                 <div class="answer-type-choice checkout-form">
                                    <label for="rdo-31{{ $i }}" id="label_1{{ $val['id']}}" class="btn-radio selectedAnswer">
                                       <input type="radio" id="rdo-31{{ $i }}"  name="radio-grp{{ $val['id']}}" class="mcq_answer"  option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                       <svg width="30px" height="30px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor1{{ @$val['id'] }}"></path>
                                       </svg>
                                       <span class="checkmark">א  </span>
                                       {{ \Illuminate\Support\Str::limit($val['optionA'], 15, $end='') }}
                                    </label>
                                    <label for="rdo-32{{ $i }}" id="label_2{{ $val['id']}}" class="btn-radio selectedAnswer">
                                       <input type="radio" id="rdo-32{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                       <svg width="30px" height="30px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor2{{ @$val['id'] }}"></path>
                                       </svg>
                                       <span class="checkmark">ב </span>
                                       {{ \Illuminate\Support\Str::limit($val['optionB'], 15, $end='') }}
                                    </label>
                                    <label for="rdo-33{{ $i }}" id="label_3{{ $val['id']}}" class="btn-radio selectedAnswer">
                                       <input type="radio" id="rdo-33{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                       <svg width="30px" height="30px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor3{{ @$val['id'] }}"></path>
                                       </svg>
                                       <span class="checkmark">ג  </span>
                                       {{ \Illuminate\Support\Str::limit($val['optionC'], 15, $end='') }}
                                    </label>
                                    <label id="label_4{{ $val['id']}}" for="rdo-34{{ $i }}" class="btn-radio selectedAnswer">
                                       <input type="radio" id="rdo-34{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                       <svg width="30px" height="30px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor4{{ @$val['id'] }}"></path>
                                       </svg>
                                       <span class="checkmark">ד  </span>
                                       {{ \Illuminate\Support\Str::limit($val['optionD'], 15, $end='') }}
                                    </label>
                                 </div>
                                 <?php
                                    }else{ ?>
                                 <div class="answer-type-choice checkout-form imgquizflex">
                                    <div class="w20">
                                       <label for="rdo-1{{ $i }}" class="btn-radio selectedAnswer">
                                          <input type="radio" id="rdo-1{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                          <svg width="30px" height="30px" viewBox="0 0 20 20">
                                             <circle cx="10" cy="10" r="9"></circle>
                                             <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor1{{ @$val['id'] }}"></path>
                                          </svg>
                                          <span class="checkmark">א</span>
                                          <img src="{{ asset('/assets/images/') }}/{{$val['optionA']}}" class="quizimg" />
                                       </label>
                                       <label for="rdo-2{{ $i }}" class="btn-radio selectedAnswer" >
                                          <input type="radio" id="rdo-2{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                          <svg width="30px" height="30px" viewBox="0 0 20 20">
                                             <circle cx="10" cy="10" r="9"></circle>
                                             <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor2{{ @$val['id'] }}"></path>
                                          </svg>
                                          <span class="checkmark">ב </span>
                                          <img src="{{ asset('/assets/images/') }}/{{$val['optionB']}}" class="quizimg" />
                                       </label>
                                    </div>
                                    <div  class="w20">
                                       <label for="rdo-3{{ $i }}" class="btn-radio selectedAnswer">
                                          <input type="radio" id="rdo-3{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                          <svg width="30px" height="30px" viewBox="0 0 20 20">
                                             <circle cx="10" cy="10" r="9"></circle>
                                             <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor3{{ @$val['id'] }}"></path>
                                          </svg>
                                          <span class="checkmark">ג  </span>
                                          <img src="{{ asset('/assets/images/')}}/{{$val['optionC']}}" class="quizimg" />
                                       </label>
                                       <label for="rdo-4{{ $i }}" class="btn-radio selectedAnswer">
                                          <input type="radio" id="rdo-4{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                          <svg width="30px" height="30px" viewBox="0 0 20 20">
                                             <circle cx="10" cy="10" r="9"></circle>
                                             <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor4{{ @$val['id'] }}"></path>
                                          </svg>
                                          <span class="checkmark">ד  </span>
                                          <img src="{{ asset('/assets/images/')}}/{{$val['optionD']}}" class="quizimg" />
                                       </label>
                                    </div>
                                 </div>
                                 <?php
                                    }
                                    ?>
                                <span class="hide correct{{ $val['id'] }}" style="color:green;font-size:15px;font-weight:600;">התשובה שלך נכונה.</span>
                                <span class="hide incorrect{{ $val['id'] }}" style="color:red;font-size:15px;font-weight:600;">התשובה שלך לא נכונה.</span>
                            </div>
                        </div>
                        <div class="btns-ut">
                            <button type="button" id="wtchSolutions" class="wtchSolutions btn btn-them my-btn mt-5 main-btns">צפה בפתרון השאלה</button>
                            @if ($key > 0) 
                                <a href="#ques0{{$k.$key-1}}" id="nextPreBtn" data-tab="0{{$k.$key-1}}" role="tab" data-toggle="tab" type="button" class="btn btn-them my-btn mt-5 main-btns"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            @endif
                            <a href="#ques0{{$k.$key+1}}" id="nextPreBtn" data-tab="0{{$k.$key+1}}" role="tab" data-toggle="tab" class="btn btn-them my-btn mt-5 main-btns">לשאלה הבאה <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="tab-pane" id="showAllAns">
                        <div class="ques-cov">
                            <div class="ques-option">
                                @php
                                    if(!empty($quiz_questions)){                           
                                       $quiz_questions1 = $quiz_questions;
                                       $i = 1;
                                       $quiz_questions_chunk = array_chunk($quiz_questions,5);
                                       foreach($quiz_questions_chunk as $five_quest_key=>$five_quest_val){
                                            foreach($five_quest_val as $key=>$val){
                                            if($i>5){
                                                $class  = 'class="currentNumber hide quest_remove quest_count_'.$five_quest_key.'"';
                                            }else{                                                  
                                                $class  = 'class="currentNumber quest_remove quest_count_'.$five_quest_key.'"';
                                               }
                                            @endphp
                                                <div class="answer-type-choice checkout-form">
                                                <span class=""><b>{{ $val['question'] }}</b></span>
                                                <hr>
                                                <label for="rdo-31{{ $i }}" class="btn-radio selectedAnswer {{showCorrectAns($val['id']) == 1 ? 'correctSelectedAns' : ''}}" >
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor1{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">א  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionA'], 15, $end='') }}
                                                </label>
                                                <label for="rdo-32{{ $i }}" class="btn-radio selectedAnswer {{showCorrectAns($val['id']) == 2 ? 'correctSelectedAns' : ''}}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor2{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ב </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionB'], 15, $end='') }}
                                                </label>
                                                <label for="rdo-33{{ $i }}" class="btn-radio selectedAnswer {{showCorrectAns($val['id']) == 3 ? 'correctSelectedAns' : ''}}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor3{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ג  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionC'], 15, $end='') }}
                                                </label>
                                                <label id="label_rd_{{ $i }}" for="rdo-34{{ $i }}" class="btn-radio selectedAnswer {{showCorrectAns($val['id']) == 4 ? 'correctSelectedAns' : ''}}">
                                                   <input type="radio" id="rdo-34{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor4{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ד  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionD'], 15, $end='') }}
                                                </label>
                                             </div>
                                            @php
                                           $i++;
                                           }
                                       }
                                   }
                                @endphp
                            </div>
                        </div>                     
                    </div>
                    @endforeach                              
                </div>
            @endforeach
            @php
                $i++;
            @endphp
            @endif
         </div>
         <div class="col-lg-3" style="height: 89%;">
            <div class="main-tb">
               <ul class="nav nav-tabs tabs-left sideways">
                    @php
                        if(!empty($quiz_questions)){                           
                           $quiz_questions1 = $quiz_questions;
                           $i = 1;
                           $quiz_questions_chunk = array_chunk($quiz_questions,5);
                           foreach($quiz_questions_chunk as $five_quest_key=>$five_quest_val){
                                foreach($five_quest_val as $key=>$val){
                                if($i>5){
                                    $class  = 'class="currentNumber active'.$five_quest_key.$key.' hide quest_remove quest_count_'.$five_quest_key.'"';
                                }else{
                                    if($i==1){
                                       $add_active = "active";
                                    }else{
                                       $add_active = "";
                                    }
                                    $class  = 'class="currentNumber active'.$five_quest_key.$key.' quest_remove quest_count_'.$five_quest_key.' '.$add_active.'"';
                                   }
                                @endphp
                                    <li <?php echo ($i>5) ? $class :$class; echo ($i==1) ? ' class="active"': ''; ?>>
                                       <a href="#ques{{$five_quest_key.$key}}" id="ques{{$five_quest_key.$key}}" aria-controls="ques{{$five_quest_key.$key}}" role="tab" data-toggle="tab" qestion_id="{{$val['id']}}" class="question_li_cls result_cls{{$val['id']}}" data-toggle="tab"><i class="fa " aria-hidden="true">{{$i}}</i></a>
                                    </li>
                                @php
                               $i++;
                               }
                           }
                       }
                    @endphp
                    {{-- <li class="active">
                        <a href="#home-v" data-toggle="tab">1</a>
                    </li>
                    <li>
                        <a href="#profile-v" data-toggle="tab">
                            <i class="fa fa-times" aria-hidden="true"></i>2
                        </a>
                    </li>
                    <li>
                        <a href="#messages-v" data-toggle="tab">
                            <i class="fa fa-check" aria-hidden="true"></i>3
                        </a>
                    </li>
                    <li>
                        <a href="#settings-v" data-toggle="tab">4</a>
                    </li> --}}
               </ul>
               <a href="{{ route('front.mycourse.show', Request::segment(2)) }}" type="button" class="btn btn-them my-btn mt-5 main-btns" id="nv-tbs">חזרה לנגן הקורס</a>
            </div>
         </div>
      </div>
   </div>
</div>


{{-- <div class="course-details-area default-padding pt-0" style="direction: rtl;">
   <div class="container">
      <div class="quiz-header">
         div class="quiz-title">
            <h1>מבוא למיקרו-כלכלה - המכללה האקדמית ספיר</h1>
            <h2>סימולציה</h2></div>
         <div class="row mb-20 mt-20">
            <div class="col-md-4">
               <div class="quiz-header-actions text-left">
                  <button type="button" id="wtchSolutions"  class="wtchSolutions btn circle btn-join effect btn-md"><img height="20px" src="{{ asset('/assets/img/viewsolution.png') }}"/> <span>צפה בפתרון
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
                            echo $quiz_data['quiz_title'];
                        }
                        ?>
                  </h1>
                  <!--<h1>מבוא למיקרו-כלכלה - המכללה האקדמית ספיר</h1>
                     -->                     
               </div>
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
                                   $class  = 'class="currentNumber hide quest_remove quest_count_'.$five_quest_key.'"';
                               }else{
                                   if($i==1){
                                       $add_active = "active";
                                   }else{
                                       $add_active = "";
                                   }
                                   $class  = 'class="currentNumber quest_remove quest_count_'.$five_quest_key.' '.$add_active.'"';
                               }
                           ?>
                        <li <?php echo ($i>5) ? $class :$class; echo ($i==1) ? ' class="active"': ''; ?>>
                           <a href="#ques{{$five_quest_key.$key}}" aria-controls="ques{{$five_quest_key.$key}}" role="tab" data-toggle="tab" qestion_id="{{$val['id']}}" class="question_li_cls result_cls{{$val['id']}}">{{$i}}</a>
                        </li>
                        <?php
                           $i++;
                           }
                           }
                           }
                           ?>
                        <!--
                           <li  class="active"><a href="#ques1" aria-controls="ques1" role="tab" data-toggle="tab">1</a></li>
                           <li><a href="#ques2" aria-controls="ques2" role="tab" data-toggle="tab">2</a></li>
                           <li><a href="#ques3" aria-controls="ques3" role="tab" data-toggle="tab">3</a></li>
                           <li><a href="#ques4" aria-controls="ques4" role="tab" data-toggle="tab">4</a></li>
                           <li><a href="#ques5" aria-controls="ques5" role="tab" data-toggle="tab">5</a></li>
                           -->
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
                              $lastElement = end($quiz_questions1);
                              $countquestion = count($quiz_questions1);
                              
                              $i=1;
                              $countingquestion=0;
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
                                       ?>
                                    <div role="tabpanel" dataid="{{ $val['id'] }}" class="viewSolution questionMainDiv{{ @$val['id'] }} tab-pane tabpanel{{ $k.$key }} <?php echo ($key==0)?'active':'';  ?>" id="ques{{$k.$key}}">
                                       <div class="quiz-question-body">
                                          <div class="question-title">
                                             <h4><span class="imgquestion"><img src="{{ asset('/assets/img/question-mark.png') }}"/></span>
                                                שְׁאֵלָה
                                                {{ $i }} 
                                             </h4>
                                          </div>
                                          <div class="question-content">
                                             <span>
                                             ? {{ $val['question'] }}
                                             </span>
                                          </div>
                                          <div class="question-control">
                                             <?php
                                                if($val['questionType'] == 1){
                                                ?>
                                             <div class="answer-type-choice checkout-form">
                                                <label for="rdo-31{{ $i }}" class="btn-radio selectedAnswer" >
                                                   <input type="radio" id="rdo-31{{ $i }}"  name="radio-grp{{ $val['id']}}" class="mcq_answer"  option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor1{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">א  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionA'], 15, $end='') }}
                                                </label>
                                                <label for="rdo-32{{ $i }}" class="btn-radio selectedAnswer">
                                                   <input type="radio" id="rdo-32{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor2{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ב </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionB'], 15, $end='') }}
                                                </label>
                                                <label for="rdo-33{{ $i }}" class="btn-radio selectedAnswer">
                                                   <input type="radio" id="rdo-33{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor3{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ג  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionC'], 15, $end='') }}
                                                </label>
                                                <label for="rdo-34{{ $i }}" class="btn-radio selectedAnswer">
                                                   <input type="radio" id="rdo-34{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                   <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                      <circle cx="10" cy="10" r="9"></circle>
                                                      <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor4{{ @$val['id'] }}"></path>
                                                   </svg>
                                                   <span class="checkmark">ד  </span>
                                                   {{ \Illuminate\Support\Str::limit($val['optionD'], 15, $end='') }}
                                                </label>
                                             </div>
                                             <?php
                                                }else{ ?>
                                             <div class="answer-type-choice checkout-form imgquizflex">
                                                <div class="w20">
                                                   <label for="rdo-1{{ $i }}" class="btn-radio selectedAnswer">
                                                      <input type="radio" id="rdo-1{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='1' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                      <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                         <circle cx="10" cy="10" r="9"></circle>
                                                         <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor1{{ @$val['id'] }}"></path>
                                                      </svg>
                                                      <span class="checkmark">א</span>
                                                      <img src="{{ asset('/assets/images/') }}/{{$val['optionA']}}" class="quizimg" />
                                                   </label>
                                                   <label for="rdo-2{{ $i }}" class="btn-radio selectedAnswer" >
                                                      <input type="radio" id="rdo-2{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='2' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                      <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                         <circle cx="10" cy="10" r="9"></circle>
                                                         <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor2{{ @$val['id'] }}"></path>
                                                      </svg>
                                                      <span class="checkmark">ב </span>
                                                      <img src="{{ asset('/assets/images/') }}/{{$val['optionB']}}" class="quizimg" />
                                                   </label>
                                                </div>
                                                <div  class="w20">
                                                   <label for="rdo-3{{ $i }}" class="btn-radio selectedAnswer">
                                                      <input type="radio" id="rdo-3{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='3' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                      <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                         <circle cx="10" cy="10" r="9"></circle>
                                                         <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor3{{ @$val['id'] }}"></path>
                                                      </svg>
                                                      <span class="checkmark">ג  </span>
                                                      <img src="{{ asset('/assets/images/')}}/{{$val['optionC']}}" class="quizimg" />
                                                   </label>
                                                   <label for="rdo-4{{ $i }}" class="btn-radio selectedAnswer">
                                                      <input type="radio" id="rdo-4{{ $i }}" name="radio-grp{{ $val['id']}}" class="mcq_answer" option='4' question-id="{{ $val['id']}}" topic_id="{{ $val['topic_id']}}" quiz_id="{{ $val['quiz_id'] }}">
                                                      <svg width="30px" height="30px" viewBox="0 0 20 20">
                                                         <circle cx="10" cy="10" r="9"></circle>
                                                         <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer roundcolor4{{ @$val['id'] }}"></path>
                                                      </svg>
                                                      <span class="checkmark">ד  </span>
                                                      <img src="{{ asset('/assets/images/')}}/{{$val['optionD']}}" class="quizimg" />
                                                   </label>
                                                </div>
                                             </div>
                                             <?php
                                                }
                                                ?>
                                          </div>
                                          <span class="hide correct{{ $val['id'] }}" style="color:green;font-size:15px;font-weight:600;">התשובה שלך נכונה.</span>
                                          <span class="hide incorrect{{ $val['id'] }}" style="color:red;font-size:15px;font-weight:600;">התשובה שלך לא נכונה.</span>
                                       </div>
                                       <span class="viewAnswer" style="display:none;">{{ @$val['answer'] }}</span>
                                    </div>
                                    <?php
                                       $i++;
                                       $countingquestion++;
                                       
                                       if($countquestion === $countingquestion){
                                       ?>
                                    <a href="#showResultpopup" class="btn btn-primary showResultpopup showResultpopupcls" quiz_id="{{$val['quiz_id']}}" topic_id="{{ $val['topic_id'] }}" data-toggle="modal" data-backdrop="static" data-keyboard="false" style="display:none;width: 30%;">צפה בפתרון כל השאלות</a>
                                    <?php
                                       }
                                       
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <?php
                              }
                                                  }
                                                  ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ********************* QUIZ QUESTION RESULT POP UP START ****************** -->
<div class="modal showResultpopup" id="showResultpopup">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- modal header -->
         <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         </div>
         <!-- modal header ends -->
         <!-- Modal body -->
         <div class="modal-body">
            <ul class="nav nav-pills" style="display: flex;justify-content: flex-end;">
               <li>
                  <a data-toggle="tab" href="javascript:void(0);" aria-expanded="false">תוצאת החידון</a>
               </li>
            </ul>
            <div class="tab-content tab-content-info" style="direction: rtl;">
               <!-- Single Tab -->
               <div id="login1" class="tab-pane fade active in">
                  <div class="form-wraper">
                     <h3 class="mb-0"></h3>
                     <div class="form-group">
                        <label>Number of question:<span class="totalQuestion"></span> </label>
                     </div>
                     <div class="form-group">
                        <label>Correct your answers: <span class="totalCorrectAnswer"></span> </label>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="button" class="log-btn form-btn" style="width: 30%;" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">Close</span> </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> --}}
</div>
<!-- ********************* QUIZ QUESTION RESULT POP UP END ****************** -->
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
  $(document).on('click', '#nextPreBtn', function(){
    var tab = $(this).data('tab');
    $('.currentNumber').removeClass('active');
    $('.active'+tab+'').addClass('active');
  });
   $(document).on("click",".wtchSolutions",function(){
   
       var radiobutton = "radio-grp"+$(this).attr('dataid');
       var nth = parseInt($(".questionMainDiv"+$(this).attr('dataid')).find('.viewAnswer').text()) - parseInt(1);
       $("input[name='"+radiobutton+"']:eq("+nth+")").click();
       $(".roundcolor"+nth+parseInt($(this).attr('dataid'))).css('stroke','green !important');
       $(".roundcolor"+parseInt($(".questionMainDiv"+$(this).attr('dataid')).find('.viewAnswer').text())+parseInt($(this).attr('dataid'))).css({"color":"red", "stroke":"green"});
       //  $(this).attr('dataid');
       //$(".questionMainDiv"+$(this).attr('dataid')).find("svg").closest('path').addClass("roundcolor");
   
       // $('.viewSolution').each(function(){
       //     if($('.viewSolution').hasClass('active')){
       //         $(".solution_"+$(this).attr('dataid')).show();
       //     }
       // });
       // var question_id_arr = [];
       // $('.question_li_cls').each(function(){
       //     question_id_arr.push($(this).attr('qestion_id'));
       // });
       // console.log(question_id_arr);
       // $.ajax({
       // url: '{{ route("front.correctAnswerList") }}',
       //     type: 'POST',
       //     data: {questionIdArr:question_id_arr},
       //     dataType:'JSON',
       //     headers: {
       //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       //     },
       //     success: function (response) {
       //         $.each(response.data, function (key, value) {
       //             if(value == 1){
       //                 $(".result_cls"+key).addClass('greenflag');
       //             }else if(value == 0){
       //                 $(".result_cls"+key).addClass('redflag');
       //             }else{
       //                 //$(".result_cls"+key).addClass('defaultflag');
       //             }
       //         });
       //     }
       // });
   });
   
   
       $(document).on("click",".showResultpopup",function(){
   
           let quiz_id = $(this).attr('quiz_id');
           let topic_id = $(this).attr('topic_id');
           let token = $('meta[name=csrf-token]').attr('content');
   
           $.ajax({
               url: '{{ route("front.showQuizResult") }}',
               type: 'POST',
               dataType:'JSON',
               data: {quizId:quiz_id,topicId:topic_id,_token:token},
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (response) {
                   if ($.isEmptyObject(response.error)) {
                           console.log(response);
                           $(".totalQuestion").text(response.questionCount);
                           $(".totalCorrectAnswer").text(response.correctAnswer);
                   } else {
                       printErrorMsg(response.error);
                   }
               }
           });
       });
   
   
       $(document).on("click",".mcq_answer",function(){ 
   
           let question_id = $(this).attr("question-id");
           let topic_id = $(this).attr("topic_id");
           let quiz_id = $(this).attr("quiz_id");
           let choose_option = $(this).attr("option");           
           let token = $('meta[name=csrf-token]').attr('content');
           $.ajax({
                   url: '{{ route("front.chooseAnswer") }}',
                   type: 'POST',
                   dataType:'JSON',
                   data: {choose_option:choose_option,question_id:question_id,topic_id:topic_id,quiz_id:quiz_id},
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success: function (response) {
                       if ($.isEmptyObject(response.error)) {
                           console.log(response.message);                           
                           if(response.message == 1){
                              // $('.selectedAnswer').removeClass('wrongSelectedAns');
                              $('#label_'+choose_option+''+question_id).addClass('correctSelectedAns');
                              $(".correct"+question_id).removeClass('hide');
                              $(".incorrect"+question_id).addClass('hide');
                              $('.sideways .active a i').removeClass('fa-times');
                              $('.sideways .active a i').addClass('fa-check');
                           }else{                            
                              // $('.selectedAnswer').removeClass('correctSelectedAns');
                              $('#label_'+choose_option+''+question_id).addClass('wrongSelectedAns');
                              $('.sideways .active a i').addClass('fa-times');
                              $('.sideways .active a i').removeClass('fa-check');
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
   
       $(function(){
           $('.question_li_cls').first().click();
           $('.question_li_cls').last().addClass("showResBtn");
       });
       $(document).on("click",".question_li_cls",function(){
           if($(this).hasClass('showResBtn')){
               $(".showResultpopupcls").show();
           }else{
               $(".showResultpopupcls").hide();
           }
           $(".wtchSolutions").attr("dataId",$(this).attr("qestion_id"));
           var stepval = 1;
           var currentStep = $(this).text();
           //console.log(currentStep);
           if(currentStep <= 5){
             stepnext(1);
           }else if(currentStep <= 10){
               stepnext(2);
           }else if(currentStep <= 15){
               stepnext(3);
           }else if(currentStep <= 20){
               stepnext(4);
           }
       });
       //$('ul li:gt(2)').hide();
   
   
</script>
@endsection