<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function create(){
        return view('admin.upload');
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'file'=> 'required|file|max:10240', 
            'expiration_minutes' => 'required|integer|min:1|max:60', 
        ]);

        // store the file in database
        $file = $request->file('file');
        $path = $file->store('iploads','public'); //this will store in storage/app/public/uplods folder
        $originalName = $file->getClientOriginalName();

        // create diff token and expiration time
        $token = Str::uuid();
        $expireAt = now()->addMinutes((int) $request->expiration_minutes);

        // save files
        $fileRecord = File::create([
            'user_id'=>Auth::id(),
            'name'=>$originalName,
            'path'=>$path,
            'token'=>$token,
            'expires_at'=>$expireAt,
            'is_used'=>false, // initially not used
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'File uploaded successfully!');
    }
}
