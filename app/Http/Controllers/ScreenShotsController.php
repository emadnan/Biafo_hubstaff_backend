<?php

namespace App\Http\Controllers;
use App\Models\ScreenShot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class ScreenShotsController extends Controller
{
    function add_screen_shots(){
        $ScreenShot = new ScreenShot();
        $ScreenShot->user_id = \Request::input('user_id');
        $ScreenShot->company_id = \Request::input('company_id');
        $ScreenShot->department_id = \Request::input('department_id');
        $ScreenShot->project_id = \Request::input('project_id');
        $ScreenShot->attechment_path = \Request::input('attechment_path');
        $ScreenShot->start_time = \Request::input('start_time');
        $ScreenShot->updated_time = \Request::input('updated_time');
        $ScreenShot->end_time = \Request::input('end_time');
        $ScreenShot->save();
        return response()->json(['message'=>'Add screen shot successfully']);
    }

    function update_screen_shots(){
        $id = \Request::input('id');
        $ScreenShot = ScreenShot::where('id',$id)
        ->update([
            'user_id' => \Request::input('user_id'),
            'company_id' => \Request::input('company_id'),
            'department_id' => \Request::input('department_id'),
            'project_id' => \Request::input('project_id'),
            'attechment_path' => \Request::input('attechment_path'),
            'start_time' => \Request::input('start_time'),
            'updated_time' => \Request::input('updated_time'),
            'end_time' => \Request::input('end_time')
        ]);

        return response()->json(['Message' => 'Screen_short Updated']);
    }

    public function get_ScreenShot()
    {
        $ScreenShot = ScreenShot::get();
        return response()->json(['ScreenShot' => $ScreenShot]);
    }

    function delete_ScreenShot(){
        $id = \Request::input('id');
        $ScreenShot = ScreenShot::where('id',$id)->delete();
        
        return response()->json(['message'=>'delete ScreenShot successfully']);
    }

    function take_screenshort(Request $request ){
        //store array of 64 base image
        $images = $request->input('screenshot');
        foreach($images as $image)
        {
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = uniqid().'.'.'png';
            \File::put(public_path(). '/screenshots/' . $imageName, base64_decode($image));
        }
        return response()->json(['message'=>'Add screen shot successfully']);
    }

    public function saveFile(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'file' => 'required|file',
        ]);
        $file = $request->file('file');
        $folder = 'uploads';

        // Generate a unique filename
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // // Store the file in the specified folder
        // Storage::disk('public')->putFileAs($folder, $file, $filename);
        $path = $file->move(public_path().'/uploads/', $filename);
        // $storedFile = new 
        // $storedFile->path = $folder . '/' . $filename;
        // $storedFile->save();

        return response()->json(['message' => 'File saved successfully', 'path'=>$path], 200);
    }
}
    