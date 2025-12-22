<?php

namespace App\Models\UserManagement;

use App\Models\AdminPanel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'basic',
        'bonus',
        'allowance',
        'deduction',
        'net_salary',
    ];

    protected $casts = [
        'basic' => 'decimal:2',
        'bonus' => 'decimal:2',
        'allowance' => 'decimal:2',
        'deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    /**
     * Relationship: Salary belongs to a User (AdminPanel)
     */


    /**
     * Optional: Compute net salary dynamically
     */
    public function getCalculatedNetSalaryAttribute()
    {
        return ($this->basic + $this->bonus + $this->allowance) - $this->deduction;
    }
     public function adminPanel()
    {
        return $this->belongsTo(AdminPanel::class, 'user_id');
    }
}
