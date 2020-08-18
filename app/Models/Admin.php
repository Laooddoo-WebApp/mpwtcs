<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'PID';

    /**
     * Get Admin details by email or username.
     *
     * @var queryBuilder
     */
    public function getAdminDetailsByUsernameOrEmail($username)
    {
        return $this->where('username', $username)->orWhere('emailID', $username);
    }

    /**
     * Get Admin/AdminPolicy details by emailID
     *
     * @var queryBuilder
     */
    public function getAdminAndPolicyDetailsByEmail($emailID)
    {
        return $this->join('adminPolicy', 'adminPolicy.PID', '=', 'admin.adminPolicyID')
            ->where('admin.emailID', $emailID);
    }

}
