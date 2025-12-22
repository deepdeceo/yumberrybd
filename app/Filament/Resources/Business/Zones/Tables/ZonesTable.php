<?php

namespace App\Filament\Resources\Business\Zones\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ZonesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('city.name')
                    ->label('City')
                    ->sortable()
                    ->searchable(),

                // জোনের নাম
                TextColumn::make('name')
                    ->label('Zone Name')
                    ->sortable()
                    ->searchable(),

                // লোকেশন (এটি যেহেতু অ্যারে, তাই আমরা কয়টি পয়েন্ট আছে তা দেখাতে পারি অথবা হাইড রাখতে পারি)
                TextColumn::make('location')
                    ->label('Area Points')
                    ->state(function ($record) {
                        return count($record->location ?? []) . ' points defined';
                    })
                    ->badge()
                    ->color('gray'),

                // অ্যাক্টিভ স্ট্যাটাস (বাইজ বা আইকন হিসেবে দেখালে সুন্দর লাগে)
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                // তৈরি করার তারিখ
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('Filter by City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),

                // ২. স্ট্যাটাস অনুযায়ী ফিল্টার (Active/Inactive)
                TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->boolean()
                    ->trueLabel('Only Active Zones')
                    ->falseLabel('Only Inactive Zones')
                    ->native(false), // ড্রপডাউন সুন্দর দেখাবে
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
