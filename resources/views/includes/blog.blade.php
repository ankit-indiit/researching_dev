@extends('layouts.app')

@section('title', ' בלוג ')

@section('content')
<style type="text/css">
  .blog-article .tab-pane.fade.in.fiximgHeight.active {
      display: flex !important;
      flex-wrap: wrap;
  }
</style>
<div class="banner-inner-area2 inimg">
  <img src="{{ asset('/assets/img/blog/banner.jpg') }}"/>
</div>
<!-- Start Breadcrumb  -->
<div class="breadcrumb-inner-area" style="">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> דף הבית</a></li>
          <li class="active">בלוג </li>
          <li class="category_breadcrumb"> קטגוריות   </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- End Breadcrumb -->
<div class="blog-question pt-40">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <div class="ques-main">
          <div class="ques-blog">
            <h3> האם תרצה שנעזור לך להצליח במבחן</h3>
          </div>
        <div class="ques-options">
          <ul>
            <li>
		        <a href="#blogscroll">לא תודה, אני מעדיף לעשות את זה לבד   </a>
		        </li> 
            <li class="txthigh">
		           <a class="textglow" href="{{url('/')}}">
		               כן אני רוצה להצליח, איך להתחיל?
		                <!--<strong>?</strong> כן אני רוצה להצליח, איך מתחילים--> </a>
		        </li>
		        <li class="optiontab" style="display:none">
		        <a  class="textglow" href="javascript:void(0)"> <strong>?</strong> מהו הנושא שתרצה ללמוד</a>
		        </li>
		      </ul>

          <!-- <ul>
            <li class="optionb">
            <a href="#">לא תודה, אני מעדיף לעשות את זה לבד   </a>
            </li> 
            <li class="optiona">
            <a href="index.html"> <strong>?</strong> כן אני רוצה להצליח, איך מתחילים</a>
            </li>
            <li class="optionab" style="display:none">
            <a href="javascript:void(0)"> <strong>?</strong> מהו הנושא שתרצה ללמוד</a>
            </li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="blog-article blogScaleEffect default-padding pt40" id = "blogscroll"  style="direction:rtl">
  <div class="container">
    <div class="row">
      <div class="tabblog  col-md-12">
        <ul class="nav nav-pills  justify-content-center">
          <?php
            foreach ($categories as $key=>$category) { 
			$isactive = ($key==0) ? 'active' : '';
          ?>
		  <li class="{{ $isactive }}"> 
            <a class = "show_blogs" data-toggle="tab" data-id ="{{ $category->id }}" data-name ="{{$category->name}}" aria-expanded="false">
                  {{$category->name}}
            </a> 
          </li>
          <?php } ?>
        </ul>
		  </div>
			<div class="col-md-12 blogflex">
         <div class="ajax-load text-center" style="display:none">
            <i class="fa fa-spinner fa-spin" style="color: #dd4b39; font-size:36px"></i>
          </div>
        <div class="row blog-content">

        </div>
         
		  </div>
    
    </div>
    <?php
      foreach ($categories as $category) {
	    $isactive = ($key==0) ? 'block' : 'none';
    ?>
    <div id="tab{{$category->id}}" class="tab-pane fade active in fiximgHeight" style = "display: {{$isactive}};">
      <div class="row">
        <div class="col-md-4">
          <div class="blog_grid_post blog_image scaleEffect">
            <div class="thumb">
              <img class="img-fluid"  alt="">
            </div>
            <div class="details">
            <a href=""></a>
              <ul class="post_meta">
                <li><span class="ti-user"></span></li>
                <li><span>ג'ון סמית</span></li>
                <li><span class="ti-comments"></span></li>
                <li><span>2 הערות</span></li>
              </ul>
              <p></p>
            </div>
        </div>
      </div> 
    </div>
  </div>
  <?php } ?>
  <input type="hidden" id="last_page" name="last_page" value="{{$results->lastPage()}}">
  
</div>
</div>
</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

  $(document).ready(function(){
      
    var last_page = $('#last_page').val();
    var url = window.location;
    var page = 1;
	 show_category_post($(".show_blogs").first());
    //loadMoreData(page);
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          if(page <= last_page){
            page ++;
            loadMoreData(page);
          }
            
        }
    });

    function loadMoreData() {
        $.ajax({
            url: url + '?page=' + page,
            datatype: "html",
            type: "get",
            beforeSend: function() {
                $('.ajax-load').show();
            }
        }).done(function(data) {
            if(data.length == 0) {
                $('.ajax-load').html("No more records found");
                return;
            }
            $('.ajax-load').hide();
            $(".blog-content").append(data);
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            alert('server not responding...');
        });
    }
    $(".ques-options ul li.optionb ").click(function(){ 
        $(".ques-options .optiona").hide();
        $(".ques-options .optionb").hide();
        $(".ques-options .optionab").show();
    });
    $('.category-carousel').owlCarousel({
	margin:20,
    nav: true,
    dots: false,
    loop: true,
    autoplay: true,
     responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:4
			}
		},
        navText: [
            "<i class='ti-arrow-left'></i>",
            "<i class='ti-arrow-right'></i>"
        ],
    });
    $(".show_blogs").click(function (e) {
        e.preventDefault();
    	show_category_post($(this));
    });
    });

function show_category_post(e)
{
	$('.blog-article .tab-pane.active').empty();
	$('.ajax-load').show();
	var name = e.data("name");
	$('.category_breadcrumb').text(name);
	$('.category_breadcrumb').addClass('active');
	$.ajax({
		url: "{{ Route('front.blogsbycat') }}",
		method: "GET",
		data: {id: e.attr("data-id")},
		   success: function (html) {
			 $('.ajax-load').hide();
			 $('.blog-article .tab-pane').hide();
			 $('.blog-article .tab-pane').removeClass('active');
			 $('#tab'+e.attr("data-id")).addClass('active');
			 $('#tab'+e.attr("data-id")).css('display','block');
			 $('#tab'+e.attr("data-id")).html(html);
		}
	});
}
</script>
 @endsection