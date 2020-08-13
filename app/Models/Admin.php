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
}
