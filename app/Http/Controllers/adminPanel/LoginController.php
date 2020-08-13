<?php

namespace App\Http\Controllers\adminPanel;

use DB;
use App\models\Admin;
use App\models\OTPCheck;
use App\models\AdminPolicy;
use Illuminate\Http\Request;
use App\Exceptions\ValidationError;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * This function check admin User/Password and create session 
     * @return view
     */
    public function adminLogin(Request $request)
    {
        try {
            $username = $request->input("username");
            $password = $request->input("password");
            

            $isLoginDetailCorrect =  Admin::where('username',$username)->where('password', Crypt::encrypt($password) )->count(DB::raw('1'));
            // Crypt::decrypt($password)
            if($isLoginDetailCorrect){
                return 'Done';
                // Create Session
            }
            else{
                throw new ValidationError(trans('admin.loginError'));
            }
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
