<?php

namespace App\Filament\Resources\Business\Cities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('City Name')->searchable()->sortable(),
                TextColumn::make('state')->label('State/Division')->searchable()->sortable(),
                TextColumn::make('country')->label('Country')->searchable()->sortable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => fn($state) => $state === 'Active',
                        'danger' => fn($state) => $state === 'Inactive',
                    ])
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Active Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
