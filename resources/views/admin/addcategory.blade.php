@extends('admin.layouts.app')

@section('title', ' הוסף קטגוריה ')
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
                                <li class="breadcrumb-item"><a href="blog-category.php">קטגוריות</a></li>
                                <li class="breadcrumb-item active">הוסף קטגוריה</li>
                            </ol>
                        </div>
                        <h4 class="page-title">הוסף קטגוריה</h4>
                    </div>
                </div>
            </div> 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="direction:rtl">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">הוסף קטגוריה </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="blog-category.php" class="btn btn-primary  mb-3">חזרה לקטגוריות</a>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cname">שם קטגוריה</label>
                                        <input type="text" id="cname" class="form-control" placeholder="הזן את שם הקטגוריה שלך" >
                                    </div>
                                </div>
                            <div class="col-lg-12">
                                <div class="form-group ">
                                    <label for="Cimage">תמונת קטגוריה</label>
                                    <form action="#" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"data-upload-preview-template="#uploadPreviewTemplate">
                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>
                                        <div class="dz-message needsclick">
                                            <i class="h3 text-muted dripicons-cloud-upload"></i>
                                            <h4>זרוק תמונה כאן או לחץ להעלאה.</h4>
                                        </div>
                                    </form>
                                    <!-- Preview -->
                                    <div class="dropzone-previews mt-3" id="file-previews"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> שלח</button>
                                <button type="button" class="btn btn-light waves-effect waves-light m-1"><i class="fe-x mr-1"></i> לְבַטֵל</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div><!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->
</div>
</div>
</div>
</div>
@endsection