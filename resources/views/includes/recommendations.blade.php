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
<div class="default-padding pt-0 ptIns" style="direction: rtl;">
    <div class="container">
        <div class="row">
       		<div class="col-md-12">
				<div class="site-heading text-center">
                 	<h2> רשימת המלצות מלאה</h2>
                 	<p> לורם איפסום הוא פשוט טקסט דמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקס הדמה הסטנדרטי בתעשייה. </p>
               	</div>
			</div>
<?php 
$count = count($inst_recommend);
	if($count != 0){
	    
    	foreach ($inst_recommend as $key => $value) {
    	    $user_id = $value->user_id;
    	    /*echo "<pre>";
    	    pr($value->toArray());
    	    die;*/
    		$user_image = DB::table('users')->where('id',$user_id)->pluck('avatar');
    		
    		if(count($user_image) != 0){
    			$userimage = $user_image[0];
    		}else{
    			$userimage = 'default.jpg';
    		}
    		$image =  asset('/assets/users/' .$userimage); 
	?>
		<div class="col-md-6 listrecommend  wow fadeInLeftBig  mb-30">
            <div class="recommendthumb">
				<div class="recommendthumbimg">
			 		<a href="{{ $value->course_user_social_link }}" target="_blank" ><img src="{{$image}}"></a>
			 		<div class="infoUser">
					  <h3>'ון סמית  </h3>
					  <p class="mb-0">אוניברסיטת תל אביב</p>
					  <p class="mb-0">CSE</p>
					</div>
				</div>
				<div class="recommendthumbcont">
					<span class="quotetop text-left"><i class="fa fa-quote-left"></i></span>
						<p class="mb-0">ורם איפסום הוא פשוטדמה של תעשיית ההדפסה והכתיבה. לורם איפסום היה טקסט הדמה הסטנדרטי של התעשייה מאז שנות ה 1500-, כאשר מדפסת לא ידועה לקחה מטה מסוג וסיבב אותו בכדי . לו </p>
					<span class="quotetop"><i class="fa fa-quote-right"></i></span>
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
</div>
@endsection
