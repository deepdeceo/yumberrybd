<?php

namespace App\Filament\Resources\Business\Categories;

use App\Filament\Resources\Business\Categories\Pages\CreateCategory;
use App\Filament\Resources\Business\Categories\Pages\EditCategory;
use App\Filament\Resources\Business\Categories\Pages\ListCategories;
use App\Filament\Resources\Business\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Business\Categories\Tables\CategoriesTable;
use App\Models\Business\Categories;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Categories::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::NumberedList;
    protected static string|UnitEnum|null $navigationGroup = 'Business';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
