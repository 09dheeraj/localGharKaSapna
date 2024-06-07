<?php

namespace App\Http\Controllers;

use App\Models\FavProperty;
use App\Models\PostProperty;
use App\Models\PropertyReviews;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $sessionID = session()->get('id');
        $title = "Welcome to Your Dashboard - Manage Your Activities & Insights";
        $countMyPostProperty = PostProperty::where('reg_id', $sessionID)->count();
        $countAllPostProperties = PostProperty::count();
        $countVisitorReviews = PropertyReviews::count();
        $visitorLikes = FavProperty::count();
        $countUsers = User::where('role', 'user')->count();
        $countVendors = User::where('role', 'vendor')->count();
        return view('Dashboard.dashboard', compact('title', 'countMyPostProperty', 'countAllPostProperties', 'countVisitorReviews', 'visitorLikes', 'countUsers', 'countVendors'));
    }

    public function myProfile()
    {
        $title = 'Profile Overview - Ghar Ka Sapna';
        return view('Dashboard.profile', compact('title'));
    }

    public function userList()
    {
        $title = "Comprehensive User List - Ghar Ka Sapna Admin Panel";
        $users = User::where('role', 'user')->get();
        return view('Admin.user_list', compact('title', 'users'));
    }

    public function vendorList()
    {
        $title = "Comprehensive Property Owner List - Ghar Ka Sapna Admin Panel";
        $vendors = User::where('role', 'vendor')->get();
        return view('Admin.vendor_list', compact('title', 'vendors'));
    }

    public function updateProfile(Request $request)
    {
        //dd($request->all());
        $sessionID = session()->get('id');
        $name = $request->input('user_name');
        $city = $request->input('city');
        $address = $request->input('address');
        $description = $request->input('description');

        $profileImage = null;

        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            if ($image->isValid()) {
                $originalExtension = $image->getClientOriginalExtension();
                $newExtension = 'webp';
                $uniqueName = Str::random(8) . '.' . $newExtension;

                $imagePath = public_path('assets/profile-img/' . $uniqueName);
                $image->move(public_path('assets/profileImg/'), $uniqueName);
                $profileImage = $uniqueName;
            }
        }


        $proFilData = User::where('id', $sessionID)->first();

        if ($proFilData) {
            $proFilData->name = $name;
            $proFilData->city = $city;
            $proFilData->address = $address;
            $proFilData->description = $description;
            if ($profileImage) {
                $proFilData->image = $profileImage;
            }
            $proFilData->save();

            // Update session values
            $request->session()->put([
                'name' => $proFilData->name,
                'phone' => $proFilData->phone,
                'image' => $proFilData->image,
                'city' => $proFilData->city,
                'address' => $proFilData->address,
                'description' => $proFilData->description,
                'status' => $proFilData->status
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        }

        return redirect()->back()->with('error', 'Profile not found');
    }

    public function profileImageRemove(Request $request)
    {
        $regID = $request->input('profileId');
        $profileImage = null;
        $removeImage = User::find($regID);
        if ($removeImage) {
            $removeImage->image = $profileImage;
            $removeImage->save();
            $request->session()->forget('image');
            return response()->json('success', 200);
        }
        return response()->json('Image not found', 404);
    }
}
