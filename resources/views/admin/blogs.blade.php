@extends('admin.layouts.app')

@section('title', ' בלוגים ')
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
                <li class="breadcrumb-item active">בלוגים</li>
              </ol>
            </div>
            <h4 class="page-title">בלוגים</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">כל הבלוגים </h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="{{route('admin.addblog')}}" class="btn btn-primary  mb-3 float-left">הוסף בלוג</a>
                <a href="{{route('admin.categorylisting')}}" class="btn btn-primary  mb-3  ml-2 float-left">קטגוריות</a>
                <?php 
                    $categories = DB::table('categories')->get();
                ?>
                <select class="form-control mx-w-160 ml-2 float-left" name="category" id ="category">
                            <option value = "">--בחר קטגוריה--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                            @endforeach 
                        </select>
              </div>
            </div>
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th>כותרת</th>
                    <th>קטגוריות</th>
                    <th>תַאֲרִיך</th>
                    <th>העדכון אחרון</th>
                    <th>שם הסופר</th>
                    <th>מספר צפיות</th>
                    <th>הצפיות נמשכות 30 יום</th>
                    <th>מספר שיתופים</th>
                    <th class="white-normal min-width140">מספר הפעמים שמשתמשים לחצו על תמונת המחבר</th>
                    <th>מספר התגובות</th>
                    <th>שם משתמש</th>
                    <th>סטָטוּס</th>
                    <th>פעולה</th>
                  </tr>
                </thead>
              <tbody>
                <?php foreach ($blogs_data as $blog){
                   $category_name = DB::table('categories')->where('id',$blog->category_id)->pluck('name');

                   $instructor_name = DB::table('instructors')->where('id',$blog->instructor_id)->pluck('first_name');
                   if($blog->status == '0'){
                      $status = ' טְיוּטָה  ';
                   }elseif($blog->status == '1'){
                      $status = ' לְפַרְסֵם ';
                   }else{
                      $status = ' לא לפרסם ';
                   }
                  ?>
              <tr>
                <td>{{$blog->title}}</td>
                <?php if(count($category_name) > 0){
                  $name = $category_name[0];
                }else{
                  $name = '';
                }   ?>
                <td>
                 {{$name}}
                </td>
                <td>
                  <span class="badge badge-secondary text-white">{{($blog->created_at)->format('d.m.Y')}} </span>
                </td>
                <td>
                  <span class="badge badge-secondary text-white">{{($blog->updated_at)->format('d.m.Y')}}</span>
                </td>
                <?php if(count($instructor_name) > 0){
                  $instructor = $instructor_name[0];
                }else{
                  $instructor = '';
                } ?>
                <td>
                    {{$instructor}}                      
                </td>
                <?php 
                $view = 0;
                $views = DB::table('viewhistories')->where('blog_id',$blog->id)->pluck('views');
                if($views->count() > 0){
                  $view = $views[0];
                }?>
                <td>
                  <span class="badge badge-success text-white">{{$view}} </span>
                </td>
                <?php
                $lastviews = 0;
                $now = now(); 
                $pageViews = DB::table('viewhistories')->where('blog_id', $blog->id)->select('date', 'views')->whereBetween('date', [$now->toDateString(), $now->copy()->subDays(30)->toDateString()])->get();
                if($pageViews->count() > 0){
                  $lastviews = $pageViews->views;
                }
                ?>
                <td>
                  <span class="badge badge-success text-white">{{$lastviews}}</span>
                </td>
                <td>
                  <span class="badge badge-success text-white">15 </span>
                </td>
                <td>
                  <span class="badge badge-success text-white">25 </span>
                </td>
                <td>
                  <span class="badge badge-success text-white">35 </span>
                </td>
                <td>
                                                       ג'וני
                </td>
                <td>
                  <span class="badge badge-success text-white">{{$status}}</span>
                </td>
                <td>
                  <a href="{{route('admin.editblog').'/'.$blog->id}}" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                   <a href="javascript:void(0)" class="btn btn-xs btn-primary" data-toggle="tooltip" title="לְשַׁכְפֵּל"><i class="fa fa-copy"></i></a>
                  <a data-value = "{{$blog->id}}" class="btn btn-xs btn-danger deletebtn"><i class="mdi mdi-trash-can"></i></a>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
</div>
</div>
</div>
</div>
<div id="delete_blog" class="deletemodal modal fade">
   <input type="hidden" name="deletedid" id ="deletedid" value="">
        <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-times"></i>
                </div>                      
                <h4 class="modal-title w-100">האם אתה בטוח?</h4>    
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>האם אתה באמת רוצה למחוק את הרשומות האלה? לא ניתן לבטל תהליך זה.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">לְבַטֵל</button>
                <button id = "deleted" type="button" class="btn btn-danger">לִמְחוֹק</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
<script type="text/javascript">
  // $('tbody').sortable();
  $(document).ready(function(){
    $('#category').on('change', function () {
        var category = $(this).val();
        $.ajax({
            url: "{{route('admin.blogslisting')}}",
            type: 'POST',
            data:{
              category:category
            },
            success: function (data) {
              console.log(data);
            }
        });
    });
    $('.deletebtn').click(function(){
      var id = $(this).attr('data-value');
      $('#deletedid').val(id);
      $('#delete_blog').modal('show');
    });
    $("#deleted").click(function(e) {
      e.preventDefault();
      var deleted_id = $('#deletedid').val();
      $.ajax({
        url: '{{ route("admin.deleteblog") }}',
          type: 'POST',
          dataType: 'json',
            data: {
              deleted_id:deleted_id
            },
            success: function (response) {
                if(response.status == 1){
                    window.location.reload();
                }else{
                    alert(response.msg);
                }
            }
        });
    });
  });
</script>
@endsection
