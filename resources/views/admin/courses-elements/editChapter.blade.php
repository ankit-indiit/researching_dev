<form method="POST" id = "edit_topic_form" enctype="multipart/form-data">
    @csrf()
    <input type="hidden" name="topic_id" id ="topic_id" value="{{ @$topics['id'] }}">
    <div class="row" style="direction:rtl">
      <div class="col-md-12 text-right">
        <!--<h4 class="header-title mb-3">
                  ערוך פרק
        </h4>-->
      </div>
    </div>   
        <div class="row">
           <!-- <div class="col-md-6">
                <div class="form-group">
                    <label>מֶשֶׁך</label>
                    <input id ="topic_duration" name="topic_duration" type="text"  value="{{ @$topics['topic_duration'] }}" class="form-control"  placeholder="הזן את משך הזמן">
                    <span class="text-danger error-text topic_duration_err"></span>
                </div>
            </div>-->
            <div class="col-md-12">
                <div class="form-group">
                    <label>כותרת</label>
                    <input id ="edit_topic_title" name="edit_topic_title" type="text" value="{{ @$topics['topic_name'] }}"  class="form-control" placeholder="הזן את הכותרת">
                    <span class="text-danger error-text topic_title_err"></span>
                </div>
            </div>
            <!--<div class="col-md-12">
                <div class="form-group">
                   <label>מחיר</label>
                   <input id ="topic_price" name="topic_price" type="text"  value="{{ @$topics['topic_price'] }}" class="form-control" placeholder="מחיר">
                   <span class="text-danger error-text topic_price_err"></span>
                </div>
            </div>-->
        </div>
        <div class="col-md-12">
            <div class="form-group">
              <button id = "edit_topic" type="button" class="btn btn-outline-warning waves-effect waves-light" style="margin-top:10px;">
                לְהוֹסִיף
              </button>
            </div>
        </div>
</form>



<div class="col-lg-12">
    <div class="card-box recentuser">
      <div class="row" style="direction:rtl">
            <div class="col-md-6  text-right">
              
            </div>
           <div class="col-md-6 text-left">
               
            </div>
      </div>
      <div class="table-responsive">
        <table id="orderTable"  class="table table-borderless table-hover table-nowrap table-centered m-0  datatable-table">
          <thead class="thead-light datatable-head">
            
            <tr class="datatable-row">
                <th>
                    כותרת
                </th>
                <th>
                    סוּג
                </th>
            </tr>
          </thead>
        <tbody id="container">
          <?php 
          foreach ($newfullarray as $key => $value) {
          ?>
          <tr class="draggable"  order-id="{{ $value['order_id'] }}" table-id="{{ $value['id'] }}" table-type="{{ $value['type'] }}">
            <td>
              {{ $value['name'] }} 
            </td>
            <td>
                <?php
                if( $value['type'] == '1'){
                    echo "קבצים";
                }
                elseif( $value['type'] == '2'){
                    echo "סרטונים";
                }else{
                    echo "חִידוֹן";
                }
                ?>
            </td>
          </tr>
        <?php }?>
        </tbody> 
      </table>
      <br>
      <div class="col-md-12"> 
            <div class="form-group">
              <button id="updatedorders"  type="button" class="btn btn-outline-warning waves-effect waves-light updatedorders" style="margin-top:10px;">
                שמור שינויים
              </button>
            </div>
        </div>
    </div>
  </div>
</div>