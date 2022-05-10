@extends('layouts.app')
@section('title', ' פרט הקורס שלי   ')
@section('content')
<div class="breadcrumb-inner-area pt-92">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <ul class="breadcrumb">
               <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
               <li class="active"> נגן הקורס </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!--- Chat Box Ends--->
<div class="main-covz">
   <div class="container">
      <div class="row" style="height: 100%;">
         <div class="col-lg-9" style="height: 100%;">
            <div class="tab-content">
               <button type="button" class="btn btn-them my-btn">button one</button>
               <div class="tab-pane active" id="home-v">
                  <div class="ques-cov">
                     <div class="ques-nam">First Quwse</div>
                     <div class="ques-option">
                        <strong>Lorem ipsum </strong>
                        <ul>
                           <li>Duis aute irure dolor in repreh</li>
                           <li>Duis aute irure dolor in repreh</li>
                           <li>Duis aute irure dolor in repreh</li>
                           <li>Duis aute irure dolor in repreh</li>
                           <li>Duis aute irure dolor in repreh</li>
                        </ul>
                     </div>
                  </div>
                  <div class="btns-ut">  <button type="button" class="btn btn-them my-btn mt-5 main-btns">Show</button><button type="button" class="btn btn-them my-btn mt-5 main-btns">
                     Back <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                  </div>
               </div>
               <div class="tab-pane" id="profile-v">
                  <div class="ques-cov">
                     <div class="ques-nam">Sec Quwse</div>
                     <div class="ques-option">
                        <strong>Lorem ipsum </strong>
                        <div class="cov-imgs">
                           <div class="inr-im">1.<img src="https://dev.indiit.solutions/researching_dev/public/assets/images/course_graphic_design_portfolio_feat.jpg"></div>
                           <div class="inr-im">2.<img src="https://dev.indiit.solutions/researching_dev/public/assets/images/course_graphic_design_portfolio_feat.jpg"></div>
                           <div class="inr-im">3.<img src="https://dev.indiit.solutions/researching_dev/public/assets/images/course_graphic_design_portfolio_feat.jpg"></div>
                           <div class="inr-im">4.<img src="https://dev.indiit.solutions/researching_dev/public/assets/images/course_graphic_design_portfolio_feat.jpg"></div>
                        </div>
                     </div>
                  </div>
                  <div class="btns-ut">  <button type="button" class="btn btn-them my-btn mt-5 main-btns">Show</button><button type="button" class="btn btn-them my-btn mt-5 main-btns">
                     Back <i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                  </div>
               </div>
               <div class="tab-pane" id="messages-v">Dummy</div>
               <div class="tab-pane" id="settings-v">...</div>
            </div>
         </div>
         <div class="col-lg-3" style="height: 100%;">
            <div class="main-tb">
               <p>lremipsum</p>
               <ul class="nav nav-tabs tabs-left sideways">
                  <li class="active"><a href="#home-v" data-toggle="tab">1</a></li>
                  <li><a href="#profile-v" data-toggle="tab"><i class="fa fa-times" aria-hidden="true"></i>
                     2</a>
                  </li>
                  <li><a href="#messages-v" data-toggle="tab"><i class="fa fa-check" aria-hidden="true"></i>
                     3</a>
                  </li>
                  <li><a href="#settings-v" data-toggle="tab">4</a></li>
               </ul>
               <p>lremipsum</p>
               <button type="button" class="btn btn-them my-btn mt-5 main-btns" id="nv-tbs">button one</button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Footer -->
@endsection
@section('scripts')
@endsection