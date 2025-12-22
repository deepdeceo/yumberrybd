<?php

namespace App\Models;

use App\Models\UserManagement\AdminSalary;
use App\Models\UserManagement\AreaManager;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPanel extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $table = 'admin_panels'; // আপনার কাস্টম টেবিল নাম

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * পাসওয়ার্ড সেভ করার সময় অটোমেটিক হাশ (Hash) করার জন্য।
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * ফিলামেন্ট প্যানেলে কে ঢুকতে পারবে তার লজিক।
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // এখানে আপনি চাইলে নির্দিষ্ট কোনো রোলকে ব্লক করতে পারেন
        // বর্তমানে সবাই এক্সেস পাবে যারা এই টেবিলে আছে
        return true;
    }
    public function salary()
    {
        return $this->hasOne(AdminSalary::class, 'user_id');
    }


    public function areaManager()
    {
        return $this->hasOne(AreaManager::class, 'user_id');
    }
}
