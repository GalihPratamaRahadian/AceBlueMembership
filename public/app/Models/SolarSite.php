<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarSite extends Model
{
    protected $fillable = [
        'name', 'latitude', 'longitude', 'address', 'status', 'last_update'
    ];

    public function logs()
    {
        return $this->hasMany(SolarLog::class, 'site_id');
    }
}

