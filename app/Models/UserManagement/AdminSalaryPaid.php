<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSalaryPaid extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_salary_id',
        'payment_date',
        'amount',
        'payment_method',
        'note',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Relationship: Payment belongs to a Salary record
     */
    public function salary()
    {
        return $this->belongsTo(AdminSalary::class, 'admin_salary_id');
    }

}
