<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PB_Uploads extends Model
{
    protected $table = 'pagebuilder__uploads';

    protected $fillable = [
        'page_id', 'locale', 'title', 'route'
    ];
}
