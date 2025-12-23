<?php

namespace App\Filament\Resources\UserManagement\PartnerManages\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PartnerManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->visibility('public')
                    ->circular()
                    ->extraImgAttributes([
                        'alt' => 'Logo',
                        'loading' => 'lazy',
                    ])
                    ->defaultImageUrl(url('/images/default-logo.png')),
                TextColumn::make('business_name')
                    ->label('Business Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('business_address')
                    ->label('Business Address')
                    ->limit(20) // ১০টি ক্যারেক্টার দেখাবে
                    ->searchable()
                    ->sortable(),
                TextColumn::make('business_number')
                    ->label('Business Number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('branch')
                    ->label('Branch')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_branch')
                    ->label('Total Branch')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('owner')
                    ->label('Partner User')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('city')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('isActive')
                    ->label('Active Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
                SelectFilter::make('zone')
                    ->label('Zone')
                    ->relationship('zone', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                Action::make('view_map')
                    ->icon('heroicon-m-map-pin') // ম্যাপ পিন আইকন
                    ->iconButton() // বাটনটিকে শুধু আইকন হিসেবে দেখাবে (লেবেল হাইড হবে)
                    ->color('danger') // আইকনের রং লাল হবে
                    ->tooltip('View on Google Maps') // আইকনের ওপর মাউস রাখলে লেখাটি দেখাবে
                    ->url(fn($record) => "https://www.google.com/maps/search/?api=1&query={$record->latitude},{$record->longitude}")
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->latitude && $record->longitude),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
