<?php

namespace App\Http\Controllers\adminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminPolicy;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Exception;



class AdminController extends Controller
{
    public function getAdmin(Request $request)
    {
        try {
            $adminData[] = Admin::all();

            return view('adminPanel.adminInformation', compact('adminData'));
        } catch (Exception $ex) {
            if (IsAuthEnv()) {
                return redirect()->back()->withErrors(trans('admin.default_error_response'));
            } else {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function updateAdmin(Request $request)
    {
        // compulsory parameters check
        $rules = array(
            'adminPolicyID' => 'required',
            'profileImage' => 'mimes:jpeg,jpg,png|max:' . config("app.valid_image_size_in_kilo_bytes") . '|file',
        );

        $messages = array(
            'adminPolicyID.required' => 'Admin Policy ID is required.',
            'profileImage.file' => 'version is required for file type.',
            'profileImage.mimes' => 'Only jpeg, jpg, png are allowed.',
            'profileImage.max' => 'Image size should not be greater than ' . config('app.valid_image_size_in_kilo_bytes') . 'KB',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            try {
                $adminModel = new Admin();

                //check whether admin details is available
                $adminDataProfile = $adminModel->getAdminDetails($request->adminID);

                if ($adminDataProfile->count(DB::raw('1')) != 0) {

                    $data['adminPolicyID'] = $request->adminPolicyID;

                    if (!isEmpty($request->firstName)) {
                        $data['firstName'] = $request->firstName;
                    }

                    if (!isEmpty($request->lastName)) {
                        $data['lastName'] = $request->lastName;
                    }

                    if (!isEmpty($request->profileImage)) {

                        //save image and generate path
                        $files = $request->file('profileImage');
                        $destinationPath =  config("constant.image_path_admin"); // upload path
                        $profileImage = uniqid() . date('YmdHis') . "." . $files->getClientOriginalExtension();
                        $files->move($destinationPath, $profileImage);
                        //$imagePath = $destinationPath . $profileImage;
                        $data['profileImage'] = $profileImage;

                        if (!isEmpty($adminDataProfile[0]->profileImage)) {
                            //deleting existing profile of user if new one is being uploaded
                            File::delete($adminDataProfile[0]->profileImage);
                        }
                    }
                    if (!isEmpty($data)) {
                        $adminModel->updateAdmin($request->adminID, $data);
                        return redirect()->back()->with('message', 'Update Profile Successfully');
                    } else {
                        return redirect()->back()->withErrors('No input found..!!');
                    }
                } else {
                    return redirect()->back()->withErrors('Admin Information not found');
                }
            } catch (Exception $ex) {
                if (IsAuthEnv()) {
                    return redirect()->back()->withErrors(config('constants.default_error_response'));
                } else {
                    return redirect()->back()->withErrors($ex->getMessage());
                }
            }
        }
    }

    public function addAdmin(Request $request)
    {
        // compulsory parameters check
        $rules = array(
            'emailID' => 'required|max:' . config('constants.string_max_length'),
            'adminPolicyID' => 'required',
            'profileImage' => 'mimes:jpeg,jpg,png|max:' . config("app.valid_image_size_in_kilo_bytes") . '|file',
            'username' => 'required|unique:admin,username,NULL,PID,deletedAt,NULL|max:' . config('constants.string_max_length') . ' characters',
            'password' => 'required|max:' . config('constants.string_max_length') . '|min:6',
            'confirm_password' => 'required|max:' . config('constants.string_max_length') . '|min:6',
        );

        $messages = array(

            'emailID.required' => 'Email is required.',
            'emailID.max' => "Email shouldn't greater than " . config('constants.string_max_length') . ' characters.',
            'adminPolicyID.required' => 'Admin Policy ID is required.',
            'profileImage.file' => 'version is required for file type.',
            'profileImage.mimes' => 'Only jpeg, jpg, png are allowed.',
            'profileImage.max' => 'Image size should not be greater than ' . config('app.valid_image_size_in_kilo_bytes') . 'KB',
            'username.required' => 'username is required.',
            'password.required' => 'password is required.',
            'confirm_password.required' => 'confirm password is required.',
            'username.max' => "username shouldn't greater than " . config('constants.string_max_length') . ' characters.',
            'password.max' => "password shouldn't greater than " . config('constants.string_max_length') . ' characters.',
            'confirm_password.max' => "confirm_password shouldn't greater than " . config('constants.string_max_length') . ' characters.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            try {
                $adminModel = new Admin();
                // check emailID
                $adminEmailID = $adminModel->where('emailID', $request->emailID)->get();
                if ($adminEmailID->count(DB::raw('1')) != 0) {
                    return redirect()->back()->withErrors(config('Email address is already available'));
                } else if ($request->password != $request->confirm_password) {
                    return redirect()->back()->withErrors(['The password entered is not match !!']);
                } else {
                    $data['adminPolicyID'] = $request->adminPolicyID;
                    $data['emailID'] = $request->emailID;
                    $data['username'] = $request->username;
                    $data['password'] = Crypt::encrypt($request->password);

                    if (!isEmpty($request->firstName)) {
                        $data['firstName'] = $request->firstName;
                    }

                    if (!isEmpty($request->lastName)) {
                        $data['lastName'] = $request->lastName;
                    }

                    if (!isEmpty($request->profileImage)) {
                        //save image and generate path
                        $files = $request->file('profileImage');
                        $destinationPath = config("constant.image_path_admin"); // upload path
                        $profileImage = uniqid() . date('YmdHis') . "." . $files->getClientOriginalExtension();
                        $files->move($destinationPath, $profileImage);
                        $data['profileImage'] = $profileImage;
                    }

                    if (!isEmpty($data)) {
                        $adminModel->create($data);
                        return redirect()->back()->with('message', 'Admin Created Successfully');
                    } else {
                        return redirect()->back()->withErrors('No input found..!!');
                    }
                }
            } catch (Exception $ex) {
                if (IsAuthEnv()) {
                    return redirect()->back()->withErrors(trans('admin.default_error_response'));
                } else {
                    return redirect()->back()->withErrors($ex->getMessage());
                }
            }
        }
    }

    public function deleteAdmin(Request $request)
    {
        try {
            $admin = Admin::where('PID', $request->adminID)->delete();
            if ($admin) {
                return redirect()->back()->with('message', 'Delete Admin Successfully');
            }
        } catch (Exception $e) {
            if (IsAuthEnv()) {
                return redirect()->back()->withErrors(trans('admin.default_error_response'));
            } else {
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
    }

    public function changeAdminPassword(Request $request)
    {
        // compulsory parameters check
        $rules = array(
            'newPassword' => 'required',
            'newConfirmPassword' => 'required'
        );

        $messages = array(
            'newPassword.required' => 'new password is required.',
            'newConfirmPassword.required' => 'new confirm password is required.'
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            try {
                $adminModel = new Admin();
                //check whether admin details is available
                $adminDataProfile = $adminModel->getAdminDetails($request->adminID);

                if ($adminDataProfile->count(DB::raw('1')) != 0) {
                    if ($request->newPassword != $request->newConfirmPassword) {
                        return redirect()->back()->withErrors(['The new password entered is not match !!']);
                    } else {
                        $currentDateTime = microtimeToDateTime(getCurrentTimeStamp());
                        $data['password'] = Crypt::encrypt($request->newPassword);
                        $data['lastPasswordResetTime'] = $currentDateTime;

                        if (!isEmpty($data)) {
                            $adminModel->updateAdmin($request->adminID, $data);
                            return redirect()->back()->with('message', 'Update Profile Successfully');
                        }
                    }
                } else {
                    return redirect()->back()->withErrors('Admin Information not found');
                }
            } catch (Exception $ex) {
                if (IsAuthEnv()) {
                    return redirect()->back()->withErrors(config('constants.default_error_response'));
                } else {
                    return redirect()->back()->withErrors($ex->getMessage());
                }
            }
        }
    }

}
