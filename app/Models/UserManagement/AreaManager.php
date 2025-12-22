<?php

namespace App\Models\UserManagement;

use App\Models\AdminPanel;
use App\Models\Business\Cities;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cities_id',
    ];

    /**
     * Relationship: AreaManager belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(AdminPanel::class, 'user_id');
    }

    /**
     * Relationship: AreaManager belongs to a City
     */

    public function city()
    {
        return $this->belongsTo(Cities::class, 'cities_id');
    }
}
