<?php

namespace App\Filament\Resources\Business\PartnerCommissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerCommissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Partner Commission Details')
                    ->schema([
                        // Add your form components here
                        TextInput::make('order_range')
                            ->label('Order Range')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: 1-10'),
                        TextInput::make('commission')
                            ->label('Commission Percentage')
                            ->required()
                            ->numeric()
                            ->placeholder('Ex: 5.5'),
                        TextInput::make('notes')
                            ->label('Notes')
                            ->maxLength(500)
                            ->placeholder('Optional Notes about the commission'),
                    ])->columns(1),
            ]);
    }
}
