<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Auth\Pages\Register as PagesRegister;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class PartnerRegister extends PagesRegister
{
    // এখানে আপনি আপনার কাস্টম ব্লেড ফাইলের পাথ বলে দিবেন
    protected string $view = 'filament.pages.auth.partner-register';

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(User::class),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->minLength(8) // এখানে 'confirmed' বাদ দেওয়া হয়েছে
                ])
                ->statePath('data'),
        ];
    }

    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        // ইউজার তৈরি করার সময় রোল 'partner' সেট করা হচ্ছে
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'partner',
        ]);
    }

    protected function getRedirectUrl(): string
    {
        // সরাসরি আপনার পছন্দের পাথটি এখানে দিয়ে দিন
        return '/partner/dashboard';

        // অথবা যদি আপনি রাউট নেম ব্যবহার করতে চান (বেস্ট প্র্যাকটিস):
        // return route('filament.partner.pages.dashboard');
    }
}
