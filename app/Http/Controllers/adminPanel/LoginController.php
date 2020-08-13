<?php

namespace App\Http\Controllers\adminPanel;

use App\models\Admin;
use App\models\OTPCheck;
use App\models\AdminPolicy;
use Illuminate\Http\Request;
use App\Exceptions\ValidationError;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

require_once app_path() . '/Helpers/basic.php';

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

            $adminModelRef = new Admin();

            $adminData =  $adminModelRef->getAdminDetailsByUsernameOrEmail($username)->select('PID', 'password')->limit(1)->get();

            if (count($adminData)) {
                //Check Password is Correct
                if (strEqual($password, Crypt::decrypt($adminData[0]->password))) {

                    //creating session
                    $request->session()->put([str_replace(".", "_", $request->ip()) . config('app.name') => [
                        'adminPID' => $adminData[0]->PID,
                    ]]); // creating login session

                    return redirect()->route('vDashboard');
                } else {
                    throw new ValidationError(trans('admin.loginError'));
                }
            } else {
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
