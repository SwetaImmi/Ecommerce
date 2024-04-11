<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function banner_list()
    {
        $banner = Banner::all();
        return view('admin.pages.banner_list', ['banner' =>  $banner]);
    }

    public function banner_view()
    {
        return view('admin.pages.banner');
    }

    public function banner_add(Request $request)
    {
        $request->validate([
            'banner_content' => 'required',
            'first_banner_content' => 'required',
            'second_banner_content' => 'required',
            'third_banner_content' => 'required',
            'last_banner_content' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'last_banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
      
            // main image
            if ($request->main_image != "") {
                $image = rand() . '.' . $request->main_image->extension();
                $request->main_image->move(('banners'), $image);
            } else {
                $image = "0";
            }
            // 1st side image
            if ($request->first_banner_image != "") {
                $first = rand() . '.' . $request->first_banner_image->extension();               
                $request->first_banner_image->move(('banners'), $first);
            } else {
                $first = "0";
            }
            // 2nd side image
            if ($request->second_banner_image != "") {
                $second = rand() . '.' . $request->second_banner_image->extension();
                $request->second_banner_image->move(('banners'), $second);
            } else {
                $second = "0";
            }
            // 3rd side image
            if ($request->third_banner_image != "") {
                $third = rand() . '.' . $request->third_banner_image->extension();
                $request->third_banner_image->move(('banners'), $third);
            } else {
                $third = "0";
            }
            // 4th side image
            if ($request->last_banner_image != "") {
                $fourth = rand() . '.' . $request->last_banner_image->extension();
                $request->last_banner_image->move(('banners'), $fourth);
            } else {
                $fourth = "0";
            }

            $banner = new Banner();
            $banner->main_banner_content   =   $request->banner_content;
            $banner->main_banner_image   =   $image;

            $banner->first_banner_content   =   $request->first_banner_content;
            $banner->first_banner_image   =   $first;

            $banner->second_banner_content   =   $request->second_banner_content;
            $banner->second_banner_image   =   $second;

            $banner->third_banner_content   =   $request->third_banner_content;
            $banner->third_banner_image   =   $third;

            $banner->last_banner_content   =   $request->last_banner_content;
            $banner->last_banner_image   =   $fourth;

            $banner->status   =   '0';
            $banner->email =  Auth::user()->email;
            $banner->save();
            return redirect('/admin/banner_list')->with('success', 'Banner Updated Successfully');

     
    }


    // Checkbox Status Changes
    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean|in:1,0'
        ]);
        
        $user = Banner::find($request->user_id);
        
        $user->status = $request->status;

        $keys = Banner::all();
        foreach ($keys as $key) {
            $satus = 0; //Example.. In real it's variable..
            DB::table('banner')
                ->where('id', $key->id)
                ->update(['status' => $satus]);
        }
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }


    public function banner_delete($id)
    {
        $banner = Banner::findOrFail($id)
            ->delete();
        return redirect()->back();
    }

}
