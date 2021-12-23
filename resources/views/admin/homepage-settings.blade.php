@extends('admin.layouts.app')

@section('title', ' דף הבית ')
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
                                <li class="breadcrumb-item active"> דף הבית </li>
                            </ol>
                        </div>
                        <h4 class="page-title"> דף הבית </h4>
                    </div>
                </div>
            </div> 
            <form action="{{ Route('admin.home.savesetting') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">  
                                    <div class="col-md-12">   
                                    <h4 class="header-title mb-3 text-right">הגדרת דף הבית</h4>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        @if(Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="homepage_funfactor">גורם מהנה </label>
                                            <label class="switch">
                                                <input type="hidden" id="homepage_funfactor" name ="homepage_funfactor" value="0">
                                                <input type="checkbox" id="homepage_funfactor" name ="homepage_funfactor" value="1" @if(isset($options['homepage_funfactor']) && $options['homepage_funfactor'] == 1) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> להציל </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection