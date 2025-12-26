<?php

namespace App\Livewire\Frontend\Web\Auth;

use App\Services\UserAuthService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]

class Login extends Component
{
    public $identifier, $password;

    protected $userAuthService;

    public function __construct()
    {
        $this->userAuthService = new UserAuthService();
    }

    public function login()
    {
        $this->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $user = $this->userAuthService->authenticateUser($this->identifier, $this->password);
            Auth::login($user);
            // Update last login
            $user->update(['last_login_at' => now()]);
            // Redirect to dashboard or home
            // Role অনুযায়ী রিডাইরেক্ট লজিক
            if ($user->role === 'partner') {
                // যদি পার্টনার হয় তবে পার্টনার প্যানেলে
                return redirect()->to('/partner');
            } elseif ($user->role === 'user') {
                // যদি সাধারণ ইউজার হয় তবে ড্যাশবোর্ডে
                return redirect()->to('/dashboard');
            }

            // ডিফল্ট রিডাইরেক্ট (যদি অন্য কোনো রোল থাকে)
            return redirect()->intended('/');
        } catch (\Exception $e) {
            $this->addError('login', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.frontend.web.auth.login');
    }
}
