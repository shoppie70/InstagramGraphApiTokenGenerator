<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

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
