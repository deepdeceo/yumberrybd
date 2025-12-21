<?php

namespace App\Filament\Resources\UserManagement\UserManages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('User Info')
                    ->description(fn($record) => $record->email ?? $record->phone)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'partner' => 'warning',
                        'rider' => 'info',
                        'user' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->sortable(),


                IconColumn::make('isPhoneVerify')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),


                ToggleColumn::make('is_premium')
                    ->label('Premium'),


                TextColumn::make('referral_code')
                    ->label('Referral')
                    ->toggleable(isToggledHiddenByDefault: true), // শুরুতে হাইড থাকবে

                // লাস্ট লগইন (সময় অনুযায়ী)
                TextColumn::make('last_login_at')
                    ->label('Last Seen')
                    ->dateTime('d M, Y H:i')
                    ->sortable()
                    ->placeholder('Never'),

                // কবে জয়েন করেছে
                TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->options([
                        'user' => 'Customer',
                        'partner' => 'Partner/Shop',
                        'rider' => 'Delivery Rider',
                    ])
                    ->indicator('Role'),


                SelectFilter::make('is_premium')
                    ->label('Membership')
                    ->options([
                        '1' => 'Premium Only',
                        '0' => 'Regular Only',
                    ])
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
