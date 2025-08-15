<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // get all files and show in the admin dashboard
        $files = File::where('user_id',Auth::id())->get();
        return view('admin.dashboard',compact('files'));
    }
}
