<?php

namespace App\Filament\Resources\UserManagement\AdminManages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdminManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color('success')
                    ->separator(','),
                TextColumn::make('salary.net_salary')
                    ->label('Net Salary')
                    ->money('BDT')
                    ->sortable(),


            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->options([
                        'super_admin' => 'Admin',
                        'opreation_manager' => 'Manager',
                        'area_manager' => 'area_manager',
                    ])
                    ->multiple(),


                SelectFilter::make('city')
                    ->label('Filter by City')
                    ->options(\App\Models\Business\Cities::pluck('name', 'id')) // সব শহরের লিস্ট দেখাবে
                    ->query(function (Builder $query, array $data): Builder {
                        if (empty($data['value'])) {
                            return $query;
                        }

                        // এটি চেক করবে ইউজারের কোনো AreaManager রেকর্ড আছে কি না যেখানে cities_id মেলে
                        return $query->whereHas('areaManager', function (Builder $query) use ($data) {
                            $query->where('cities_id', $data['value']);
                        });
                    })
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('') // লেখা মুছে ফেলার জন্য
                    ->tooltip('View Details') // মাউস নিলে লেখা দেখাবে
                    ->icon('heroicon-m-eye'), // চোখের আইকন

                EditAction::make()
                    ->label('') // লেখা মুছে ফেলার জন্য
                    ->tooltip('Edit Record')
                    ->icon('heroicon-m-pencil-square'), // কলমের আইকন
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
