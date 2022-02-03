<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogRecord extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_records';

    protected $fillable = [
        'app_id',
        'app_secret',
        'management_id',
        'access_token_1',
        'access_token_2',
        'access_token_3',
        'facebook_page_name',
        'business_account',
    ];

}