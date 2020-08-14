<?php

namespace App\Http\Controllers\adminPanel;

use Exception;
use App\models\Admin;
use App\models\OTPCheck;
use Illuminate\Http\Request;
use App\Providers\MailProvider;
use App\Exceptions\ValidationError;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
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
                        'adminID' => $adminData[0]->PID,
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
        $request->session()->forget(str_replace(".", "_", $request->ip()) . config('app.name')); // removing user session
        return redirect()->route('vAdminLogin');
    }

    /**
     * This function resend OTP and reload page
     * @return view
     */
    public function resendOTP(Request $request)
    {
        # code...
    }

    /**
     * This function send OTP and redirect to forget password Page
     * @return view
     */
    public function forgetPassword(Request $request)
    {

        try {
            $rules = array(
                'emailID' => 'bail|regex:/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/|exists:admin,emailID',
            );

            $messages = array(
                'emailID.exists' => Lang::get('admin.userNotFoundWithEmail'),
                'emailID.regex' => Lang::get('general.InvalidEmail'),
            );

            $validator = Validator::make($request->toArray(), $rules, $messages);

            if ($validator->fails()) {
                throw new ValidationError($validator->errors()->first());
            }

            $emailID = $request->input('emailID');
            $OTP = rand(1000, 9999);

            $MailProviderRef = new MailProvider(null);

            $isMailSend = $MailProviderRef->sendEMail('forgetPassword', '', $emailID, ['OTP' => $OTP]);

            if ($isMailSend) {
                $adminModelRef  = new Admin();
                $adminData = $adminModelRef->getAdminAndPolicyDetailsByEmail($emailID)->select('admin.PID', 'adminPolicy.otpValidTimeInSeconds')->get();
                $OTPCheckModelRef = new OTPCheck();

                if (count($adminData)) {
                    $currentDateTime = microtimeToDateTime(getCurrentTimeStamp());
                    $validTill = date('Y-m-d H:i:s', strtotime('+' . $adminData[0]->otpValidTimeInSeconds . ' seconds', strtotime($currentDateTime)));

                    $OTPCheckModelRef->updateOrCreate(
                        ['adminPID' => $adminData[0]->PID],
                        ['otp' => $OTP, 'validTill' => $validTill]
                    );

                    $adminPID = $adminData[0]->PID;

                    return redirect()->route('vForgetPassword', ['emailID' => $emailID, 'adminPID' => $adminPID]);
                } else {
                    throw new ValidationError(trans('admin.userNotFoundWithEmail'));
                }
            } else {
                throw new ValidationError(trans('general.serverError'));
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
     * This function check OTP and new password. Then Update Admin Password 
     * @return view
     */
    public function resetPassword(Request $request)
    {
        try {
            $rules = array(
                'adminPID' => 'bail|required',
                'otp' => 'bail|required|integer',
                'newPassword' => 'bail|required',
                'confirmPassword' => 'bail|required|same:newPassword',
            );

            $messages = array(
                'adminPID.required' => Lang::get('general.adminIdCannotEmpty'),
                'otp.required' => Lang::get('general.otpCannotEmpty'),
                'otp.integer' => Lang::get('general.otpShouldBeInt'),
                'newPassword.required' => Lang::get('general.newPasswordCannotEmpty'),
                'confirmPassword.required' => Lang::get('general.confirmPasswordCannotEmpty'),
                'confirmPassword.same' => Lang::get('general.PasswordNotMatch'),
            );

            $validator = Validator::make($request->toArray(), $rules, $messages);

            if ($validator->fails()) {
                throw new ValidationError($validator->errors()->first());
            }

            $OTPCheckModelRef = new OTPCheck();

            $otpData = $OTPCheckModelRef->checkOtpValid($request->input('adminPID'), $request->input('otp'))->get();

            if (count($otpData)) {
                $otpData[0]->delete();

                $adminModelRef = new Admin();
                $adminModelRef->where('PID', $request->input('adminPID'))
                    ->update(['password' => Crypt::encrypt($request->input('newPassword'))]);

                return redirect()->route('vAdminLogin')->with('message', trans('general.passwordUpdate'));
            } else {
                throw new ValidationError(trans('general.invalidOTP'));
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
}
