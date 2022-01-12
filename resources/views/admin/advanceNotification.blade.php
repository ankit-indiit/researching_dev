@extends('admin.layouts.app')
@section('title', 'מערכת הודעות')
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
                <li class="breadcrumb-item active">מערכת הודעות</li>
              </ol>
            </div>
            <h4 class="page-title">מערכת הודעות</h4>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="row" style="direction:rtl">
              <div class="col-md-6 text-right">
                <h4 class="header-title mb-3">מערכת הודעות</h4>
              </div>
              <div class="col-md-6 text-left">
                <a href="#addAdvanceNotification" data-toggle="modal" class="btn btn-primary  mb-3">הוסף הודעה</a>
              </div>
            </div>
            @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ Session::get('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>                  
              </div>              
            @endif 
            <div class="table-responsive">
              <table  id="basic-datatable" class="table  table-hover table-nowrap table-centered m-0">
                <thead class="thead-light">
                  <tr>
                    <th width="35%">מספר סידורי</th>
                    <th>הוֹדָעָה</th>
                    <th>קוּרס</th>
                    <th>משתמשים סופרים</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($manual_notification) > 0)
                  <?php 
                  foreach ($manual_notification as $key=>$manual) {
                  ?>
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$manual->message}}</td>
                    <td>{{ @$manual->course->course_name}}</td>
                    <td>{{count(json_decode($manual->sender_id,true))}}</td>
                  </tr>
                <?php  }?>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
<div id="addAdvanceNotification" class="renewalproduct modal fade" style="direction: rtl;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">הוסף חדש</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-right">
                <div class="form-group mb-3">
                    <label>מכון</label>
                    <select class="choosenFileter" id="filter_universities">
                        <option value="">-----</option>
                        @if(count($universities) > 0)
                            @foreach ($universities as $university)
                                <option value="{{ $university->id }}">{{ $university->university_name }}</option>
                            @endforeach
                        @endif 
                    </select>
                </div>     
                <div class="form-group mb-3">
                    <label>תוֹאַר</label>
                    <select class="choosenFileter" id="filter_degree">
                        <option value="">Please select university</option>
                    </select>
                </div> 
                <div class="form-group mb-3">
                  <label>חפש לפי שם/מייל</label>
                  <input class="form-control" type="text" id="filter_search_name" value="" placeholder="חפש לפי שם/מייל">
                  <i>הערה: לחץ על רשימת המשתמשים</i>
                </div>                                
                <div class="form-group mb-3">
                    <label>משתמשים</label>
                    <select class="js-example-basic-multiple" id="filter_user" placeholder="בחר משתמש" multiple>
                        @if(count($all_users) > 0)
                            @foreach ($all_users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }} {{ $user->email}}</option>
                            @endforeach
                        @endif 
                    </select>
                    <input type="checkbox" id="filter_selectall" >בחר הכל
                    <span class="filter_user_err error text-danger"></span>
                  </div> 
                <div class="form-group mb-3">
                    <label>הזן הודעה</label>
                    <textarea class="form-control" id="notification_message" value=""></textarea>
                    <span class="notification_message_err error text-danger"></span>
                </div>

                <div class="form-group mb-3">
                    <label>קורס (לא חובה)</label>
                    <select class="js-example-basic-multiple" id="filter_select_product" placeholder="בחר משתמש">
                        @if(count($courses) > 0)
                            <option value=""></option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
                            @endforeach
                        @endif 
                    </select>
                </div>   

                <button type="submit" id="saveNOtification" class="btn btn-outline-warning waves-effect waves-light">לְהוֹסִיף</button>
            </div>	
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function($) {
            $('#saveNOtification').on('click', function(e){
              $('.error').empty();
              e.preventDefault();
              var users = $('#filter_user').val();
              var message = $('#notification_message').val();
              var product = $('#filter_select_product').val();
              var error_focus = '';
              if(message == ''){
                $('.notification_message_err').text('Please enter message.');
                error_focus = '#notification_message';
              }              
              if(users.length < 1){
                $('.filter_user_err').text('Please Select user.');
                error_focus = '#filter_user';
              }
              if(error_focus) {
                $(error_focus).focus();
              }else{
                $('#saveNOtification').prop('disabled',true);
                $.ajax({
                    url: '{{ route("admin.advance_notification.save") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        users:users,
                        message:message,
                        product:product,
                    },
                    success: function (response) {
                      window.location.reload();
                    }
                });  
              }
            });
            $('.choosenFileter').select2({
                placeholder: "בחר ערך",
                closeOnSelect: true,
                allowClear: true,
            });
            $('#filter_user').select2({
                placeholder: "בחר משתמש",
                closeOnSelect: false,
                allowClear: true,
            });   
            $('#filter_select_product').select2({
                placeholder: "בחר קורס",
                closeOnSelect: false,
                allowClear: true,
            });   
            $("#filter_selectall").click(function(){
                if($("#filter_selectall").is(':checked') ){
                    $("#filter_user > option").prop("selected","selected");
                    $("#filter_user").trigger("change");
                }else{
                    $("#filter_user > option").prop("selected",false);
                    $("#filter_user").trigger("change");
                }
            });            
            $("#filter_search_name").on('keyup', function(e) {
                var search = $(this).val();
                var degree = $('#filter_degree').val();
                var univ = $("#filter_universities").val();
                $.ajax({
                    url: '{{ route("admin.advance_filter") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        search:search,
                        degree:degree,
                        univ:univ,
                        action:'search_term'
                    },
                    success: function (response) {
                      console.log(response);
                        if(response.users){
                          $("#filter_user").html('').select2({data: response.users,
                              placeholder: "בחר משתמש",
                              allowClear: true,
                          });    
                          $('#filter_user').val('').trigger('change.select2');                     
                        }
                    }
                });   
            });

            $("#filter_degree").on('change', function(e) {
                var degree = $(this).val();
                var univ = $("#filter_universities").val();
                var search = $("#filter_search_name").val();
                $.ajax({
                    url: '{{ route("admin.advance_filter") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        search:search,
                        degree:degree,
                        univ:univ,
                        action:'degree_change'
                    },
                    success: function (response) {
                      console.log(response);
                        if(response.users){
                          $("#filter_user").html('').select2({data: response.users,
                              placeholder: "בחר משתמש",
                              allowClear: true,
                          });    
                          $('#filter_user').val('').trigger('change.select2');                     
                        }
                    }
                });   
            });

            $("#filter_universities").on('change', function(e) {
                var univ = $(this).val();
                var search = $("#filter_search_name").val();
                if(univ == ''){
                  $("#filter_degree").html('').select2({
                      placeholder: "נא לבחור באוניברסיטה",
                      allowClear: true,
                    });
                }
                $.ajax({
                    url: '{{ route("admin.advance_filter") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        univ:univ,
                        search:search,
                        action:'university_change'
                    },
                    success: function (response) {
                      console.log(response);
                        if(response.users){
                          $("#filter_user").html('').select2({data: response.users,
                            placeholder: "בחר משתמש",
                            allowClear: true,
                          });             
                          $('#filter_user').val('').trigger('change.select2');            
                        }
                        if(response.degree){
                          
                          $("#filter_degree").html('').select2({data: response.degree,
                              placeholder: "סנן את השימוש לפי תואר",
                              allowClear: true,
                            });   
                            $('#filter_degree').val('').trigger('change.select2');

                        }
                    }
                });                
            });     
            $(document).on("keypress",".select2-input",function(event){
                if (event.ctrlKey || event.metaKey) {
                    var id =$(this).parents("div[class*='select2-container']").attr("id").replace("s2id_","");
                    var element =$("#"+id);
                    if (event.which == 97){
                        var selected = [];
                        element.find("option").each(function(i,e){
                            selected[selected.length]=$(e).attr("value");
                        });
                        element.select2("val", selected);
                    } else if (event.which == 100){
                        element.select2("val", "");
                    }
                }
            });                  
        });
    </script>
@endsection