<?php

use App\Models\Admin;
use App\Models\AdminPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class basicData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPolicyData = [array(
            'PID' => '1',
            'name' => 'SuperUser',
            'userLockTime' => null,
            'invalidAttemptsAllowed' => null,
            'otpValidTimeInSeconds' => 300,
            'passwordResetTime' => null,
        )];

        AdminPolicy::insert($adminPolicyData);

        $adminData = [array(
            'PID' => '1',
            'adminPolicyID' => '1',
            'firstName' => 'Super',
            'middleName' => '',
            'lastName' => 'User',
            'emailID' => config('constant.super_user_email'),
            'username' => 'SuperUser',
            'password' => Crypt::encrypt('Test123!')
        )];

        Admin::insert($adminData);
    }
}
