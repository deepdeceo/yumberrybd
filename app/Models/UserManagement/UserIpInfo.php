<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Model;

class UserIpInfo extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'country_name',
        'country_code',
        'region_name',
        'city_name',
        'zip_code',
        'latitude',
        'longitude',
        'timezone',
        'isp',
        'browser',
    ];
}
