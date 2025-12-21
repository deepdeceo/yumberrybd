<?php

namespace App\Filament\Resources\UserManagement\UserManages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* =========================
             | SECTION 1 — BASIC INFO
             | FULL WIDTH
             ========================= */
                Section::make('Basic Information')
                    ->description('User basic account details.')
                    ->schema([

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        TextInput::make('password')
                            ->password()
                            ->required(fn(string $operation) => $operation === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->revealable()
                            ->rule(Password::default()),
                    ]),

                /* =========================
             | SECTION 2 — STATUS & ROLES
             | FULL WIDTH
             ========================= */
                Section::make('Status & Roles')
                    ->compact()
                    ->schema([

                        Select::make('role')
                            ->options([
                                'user' => 'Customer',
                                'partner' => 'Partner / Shop',
                                'rider' => 'Delivery Rider',
                            ])
                            ->default('user')
                            ->required()
                            ->native(false),

                        Toggle::make('is_premium')
                            ->label('Premium User')
                            ->onIcon('heroicon-m-bolt')
                            ->onColor('warning'),

                        Toggle::make('isPhoneVerify')
                            ->label('Phone Verified')
                            ->onColor('success'),

                        TextInput::make('referral_code')
                            ->label('Own Referral Code')
                            ->placeholder('AUTO-GENERATED')
                            ->disabled()
                            ->visible(fn(string $operation) => $operation === 'edit'),

                        Select::make('referred_by')
                            ->relationship('referrer', 'name')
                            ->searchable()
                            ->placeholder('Search by name...'),
                    ]),
            ]);
    }
}
