<?php

namespace App\Livewire\Frontend\Web\Auth;

use App\Services\UserAuthService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]

class CreateUser extends Component
{
    public $step = 'options'; // options, mobile, email
    public $name, $mobile, $email, $password;

    protected $userAuthService;

    public function __construct()
    {
        $this->userAuthService = new UserAuthService();
    }

    public function setStep($step)
    {
        $this->step = $step;
    }

    public function createAccount()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($this->step === 'email') {
            $this->validate([
                'email' => 'required|email|unique:users,email',
            ]);
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ];
        } elseif ($this->step === 'mobile') {
            $this->validate([
                'mobile' => 'required|string|unique:users,phone',
            ]);
            $data = [
                'name' => $this->name,
                'phone' => $this->mobile,
                'password' => $this->password,
            ];
        } else {
            $this->addError('step', 'Invalid step.');
            return;
        }

        try {
            $user = $this->userAuthService->createUser($data);
            // Log the user in
            Auth::login($user);
            // Redirect to dashboard or home
            return redirect()->intended('/');
        } catch (\Exception $e) {
            $this->addError('create', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.frontend.web.auth.create-user');
    }
}
