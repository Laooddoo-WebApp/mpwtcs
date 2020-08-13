<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OTPCheck extends Model
{
    protected $table = 'otpCheck';
    protected $primaryKey = 'PID';
    
    protected $fillable = [
        'adminPID','validTill','otp'
    ];
}
