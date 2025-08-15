<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FileShared;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShareController extends Controller
{
    // This controller will handle file sharing functionalities
    // show a form to share files to with the users

    public function create(){
       $files = File::where('user_id',auth()->id())->where('is_used',false)->get();

        $users = User::where('role','user')->get();
        return view('admin.share', compact('files', 'users'));
    }

    // share the file with selected users
     public function store(Request $request)
    {
        $request->validate([
            'file_id' => ['required', 'exists:files,id'],
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['exists:users,id'],
            'expiration_minutes' => ['required', 'integer', 'min:1', 'max:60'],
        ]);

        $file = File::findOrFail($request->file_id);
        // if ($file->user_id !== auth()->id() || $file->is_used || !is_null($file->expires_at)) {
        //     return redirect()->route('admin.share')->with('error', 'Invalid file or already shared.');
        // }

        // Set expiration starting from now
        $file->expires_at = now()->addMinutes((int) $request->expiration_minutes);
        $file->save();

        // Share with selected users
        $file->sharedUsers()->sync($request->user_ids);

        // Send email to each selected user
        foreach ($request->user_ids as $userId) {
            $user = User::find($userId);
            Mail::to($user->email)->send(new FileShared($file, $user));
        }

        return redirect()->route('admin.dashboard')->with('success', 'File shared successfully.');
    }
}
