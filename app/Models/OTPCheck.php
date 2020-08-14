<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTPCheck extends Model
{
    protected $table = 'otpCheck';
    protected $primaryKey = 'PID';

    protected $fillable = [
        'adminPID', 'validTill', 'otp'
    ];

    /**
     * This query return otp with Current Datetime check
     */
    public function checkOtpValid($adminID, $otp)
    {
        $currentDateTime = microtimeToDateTime(getCurrentTimeStamp());

        return $this->where('adminPID', $adminID)
            ->where('otp', '=', $otp)
            ->where('validTill', '>', $currentDateTime);
    }
}
