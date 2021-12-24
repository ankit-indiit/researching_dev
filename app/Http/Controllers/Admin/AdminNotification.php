<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification as ModelsAdminNotification;
use Illuminate\Http\Request;

class AdminNotification extends Controller
{
    public function clearNotification(){
        ModelsAdminNotification::truncate();
    }
}
