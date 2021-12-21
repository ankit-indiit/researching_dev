@extends('layouts.app')

@section('title', 'recommendations')

@section('content')
<!-- Start Breadcrumb  -->
<div class="banner-inner-area2 pt8"></div>
<div class="breadcrumb-inner-area mb50" style="">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <ul class="breadcrumb">
          <li><a href="#"><i class="fas fa-home"></i> דף הבית</a></li>
          <li class="active">המלצות</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!--   <div class="curvedown">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="#0d0d3f" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,74.7C480,85,600,107,720,112C840,117,960,107,1080,90.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>
  </div> -->
<!-- End Breadcrumb -->
    <div class="default-padding pt-0" style="direction: rtl;">
        <div class="container">
        	<?php 
        	$count = count($recommendations);
        	if($count != 0){
        	foreach ($recommendations as $key => $value) {
        	?>
            <div class="row">
       
			    <div class="col-md-12">
				<div class="site-heading text-center">
                     <h2> רשימת המלצות מלאה</h2>
                     <p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
               </div>
				</div>
				<div class="col-md-6 listrecommend  wow fadeInLeftBig  mb-30">
                    <div class="recommendthumb">
					<div class="recommendthumbcont">
					<span class="quotetop text-left"><i class="fa fa-quote-left"></i></span>
					<p class="mb-0">{{$value->description}}</p>
					<span class="quotetop"><i class="fa fa-quote-right"></i></span>
					</div>

					</div>
					<div class="socialshare-blog">
                           <ul class="socialshare">
                              <li class="sharetext">
                                   שתף המלצה זו ב
                               </li>
                              <li>
                                 <a class="social-icon facebook" href="https://www.facebook.com/sharer.php?u=http://127.0.0.1:8080/blog/show/1" rel="me" title="Facebook" target="_blank"><i class="fab fa-facebook"></i>Facebook</a>
                              </li>
                              <li>
                                 <a class="social-icon twitter" href="https://twitter.com/share?url=http://127.0.0.1:8080/blog/show/1" rel="me" title="Twitter" target="_blank"><i class="fab fa-twitter"></i>Twitter</a>
                              </li>
                              <li>
                                 <a href="https://www.linkedin.com/shareArticle?mini=true&url=http://127.0.0.1:8080/blog/show/1" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i>LinkedIn</a>
                                  </li>
                              <li>
                                 <a  class="social-icon linkedin" href="https://api.whatsapp.com/send?text=www.google.com" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i>Whatsapp</a>
                                  </li>
                           </ul>
                        </div>
                  </div>
				
						  
                  
				</div>
			<?php }
		}else{?>
			<h4 style="text-align: center;">
				עדיין אין המלצה
			</h4>
		<?php }?>
		</div>
	</div>
  @endsection
  
