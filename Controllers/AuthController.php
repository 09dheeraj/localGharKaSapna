<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function createVendor(Request $request)
    {

        $number = $request->input('number');

        $existingNumber  = User::where('phone', $number)->first();

        if ($existingNumber) {

            $generateOtp = $this->generateVendorOtp($existingNumber->id);
            $lastFourDigit = substr($number, -4);

            return response()->json([
                'success' => "please enter the code send to  ... $lastFourDigit.",
            ]);
        } else {

            $vendor = User::create([
                'phone' => $number,
                'image' => 'portrait-dummy.png',
                'role' => 'user',
            ]);

            $generateOtp = $this->generateVendorOtp($vendor->id);
            $lastFourDigit = substr($number, -4);

            return response()->json([
                'success' => "Please enter the code send to  ... $lastFourDigit.",
            ]);
        }
    }

    public function generateVendorOtp($id)
    {
        $findOtp = Otp::where('reg_id', $id)->first();
        $now = now();

        if ($findOtp) {

            $findOtp->update([
                'otp' => str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'expires_at' => $now->addMinute(10),
            ]);
            return $findOtp;
        } else {
            $generateOtp = Otp::create([
                'reg_id' => $id,
                'otp' => str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'expires_at' => $now->addMinutes(10)
            ]);

            return $generateOtp;
        }
    }


    public function authenticateUser(Request $request)
    {
        //print_r($request->all());
        $phone = $request->input('updatePhoneNumber');
        $existingNumber = User::where('phone', $phone)->first();

        if ($existingNumber) {
            $generateOtp = $this->generateUserOtp($existingNumber->id);
            $lastFourDigits = substr($phone, -4);
            return response()->json([
                'success' => "Please enter the code send to  ... $lastFourDigits.",
            ]);
        } else {
            $user = User::create([
                'phone' => $phone,
                'image' => 'portrait-dummy.png',
                'role' => 'user',
            ]);

            $generateOtp = $this->generateUserOtp($user->id);
            $lastFourDigit = substr($phone, -4);
            return response()->json([
                'success' => "Please enter the code send to  ... $lastFourDigit.",
            ]);
        }
    }


    public function generateUserOtp($id)
    {
        $findOtp = Otp::where('reg_id', $id)->first();
        $now = now();

        if ($findOtp) {

            $findOtp->update([
                'otp' => str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'expires_at' => $now->addMinutes(10),
            ]);
            return $findOtp;
        } else {

            $generateOtp = Otp::create([
                'reg_id' => $id,
                'otp' => str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'expires_at' => $now->addMinutes(10)
            ]);

            return $generateOtp;
        }
    }


    public function verifyOtp(Request $request)
    {

        $otp = $request->input('otp');
        $findOtp = Otp::where('otp', $otp)->first();

        if ($findOtp) {
            $update_status = User::where('id', $findOtp->reg_id)->update(['status' => '1']);

            $vendor = User::find($findOtp->reg_id);

            if ($vendor) {
                $request->session()->put([
                    'id' => $vendor->id,
                    'name' => $vendor->name,
                    'phone' => $vendor->phone,
                    'role' => $vendor->role,
                    'image' => $vendor->image,
                    'status' => $vendor->status
                ]);

                return response()->json([
                    'success' => "success",
                    'message' => 'Logged in successfully as user!',

                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Invalid OTP',
            ], 400);
        }
    }

    public function adminLogin()
    {
        $title = "Unlock the Power of Management - Access Ghar Ka Sapna Admin Portal";
        return view('Admin.login', compact('title'));
    }

    public function loginAdmin(Request $request)
    {
        $phone = $request->input('phone');

        $admin = User::where('phone', $phone)->where('role', 'admin')->first();

        if ($admin) {
            $admin->status = '1';
            $admin->save();

            $request->session()->put([
                'id' => $admin->id,
                'name' => $admin->name,
                'phone' => $admin->phone,
                'role' => $admin->role,
                'image' => $admin->image,
                'status' => $admin->status
            ]);

            return redirect()->route('welcome.dashboard')->with('success', 'Welcome back, Admin! You have successfully logged in.');
        }

        return redirect()->back()->withErrors('error', 'Invalid credentials. Please check your credentials and try again.');
    }



    public function logout()
    {
        $sessionID = session()->get('id');
        if ($sessionID) {
            User::where('id', $sessionID)->update(['status' => '0']);
        }

        Auth::logout();
        \Session::flush();

        return redirect('/')->with('success', 'Logged out successfully');
    }
}
