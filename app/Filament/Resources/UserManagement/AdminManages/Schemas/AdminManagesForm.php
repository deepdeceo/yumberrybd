<?php

namespace App\Filament\Resources\UserManagement\AdminManages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdminManagesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Admin Info')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('password')->password()->required()
                            ->dehydrateStateUsing(fn($state) => bcrypt($state)),
                        Select::make('role')
                            ->options([
                                'super_admin' => 'Super Admin',
                                'operation_manager' => 'Operation Manager',
                                'finance_manager' => 'Finance Manager',
                                'support_team' => 'Support Team',
                                'product_manager' => 'Product Manager',
                                'Seller' => 'Seller',
                                'area_manager' => 'Area Manager',
                            ])
                            ->required()
                            ->reactive()
                    ]),

                Section::make('Salary Info')
                    ->relationship('salary') // ← THIS IS THE KEY
                    ->schema([
                        TextInput::make('basic')->numeric()->required(),
                        TextInput::make('bonus')->numeric(),
                        TextInput::make('allowance')->numeric(),
                        TextInput::make('deduction')->numeric(),
                        TextInput::make('net_salary')->numeric(),
                    ]),

                Section::make('Area Assignment')
                    ->relationship('areaManager')
                    ->schema([
                        Select::make('cities_id')
                            ->label('City')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->required(),
                    ])
                    ->visible(fn($get) => $get('role') === 'area_manager'),
            ]);
    }
}
