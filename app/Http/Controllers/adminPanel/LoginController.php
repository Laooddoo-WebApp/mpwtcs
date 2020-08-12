<?php

namespace App\Http\Controllers\adminPanel;

use App\models\Admin;
use App\models\OTPCheck;
use App\models\AdminPolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * This function check admin User/Password and create session 
     * @return view
     */
    public function adminLogin(Request $request)
    {
        try {
            $request->input("password");
            $request->input("password");
            
        } catch (ValidationError $e) {
            $error = ValidationException::withMessages([$e->getMessage()]);
            throw $error;
        } catch (Exception $e) {
            if (IsAuthEnv()) { // If the current environment is needed Authentication. Then return custom message
                $error = ValidationException::withMessages(['Invalid Exception.']);
            } else { // If the current environment is not needed Authentication. Then return Exception message
                $error = ValidationException::withMessages([$e->getMessage()]);
            }
            throw $error;
        }
    }

    /**
     * This function end current user session 
     * @return view
     */
    public function adminLogout(Request $request)
    {
        # code...
    }

    /**
     * This function resend OTP and reload pageF 
     * @return view
     */
    public function resendOTP(Request $request)
    {
        # code...
    }

    /**
     * This function check OTP and new password. Then Update Admin Password 
     * @return view
     */
    public function resetPassword(Request $request)
    {
        # code...
    }
}
