<?php

namespace App\Filament\Partner\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Image')
                    ->disk('public')
                    ->circular(),

                // Title & Slug
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->slug),

                // Category Relationship
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                // Pricing
                TextColumn::make('selling_price')
                    ->label('Price')
                    ->money('BDT')
                    ->sortable(),

            ])
            ->filters([
                // Category wise filter
                SelectFilter::make('category_id')
                    ->label('Filter by Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                // Status filter
                SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
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
