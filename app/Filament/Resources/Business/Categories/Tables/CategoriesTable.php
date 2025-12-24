<?php

namespace App\Filament\Resources\Business\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Category Name')
                    ->sortable()
                    ->searchable(),

                // Parent Category er name dekhabe
                TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->placeholder('Root') // Parent na thakle 'Root' dekhabe
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge() // Badge dile dekhte bhalo lage
                    ->color(fn(string $state): string => match ($state) {
                        'shop' => 'success',
                        'resturent' => 'warning',
                        'pharmacy' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                // Type wise filter
                SelectFilter::make('type')
                    ->options([
                        'shop' => 'Shop',
                        'resturent' => 'Restaurant',
                        'pharmacy' => 'Pharmacy',
                    ]),

                // Parent wise filter (optional but helpful)
                SelectFilter::make('parent_id')
                    ->label('Parent Category')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload(),
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
