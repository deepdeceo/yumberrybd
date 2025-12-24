<?php

namespace App\Filament\Resources\Warehouse\Products;

use App\Filament\Resources\Warehouse\Products\Pages\CreateProduct;
use App\Filament\Resources\Warehouse\Products\Pages\EditProduct;
use App\Filament\Resources\Warehouse\Products\Pages\ListProducts;
use App\Filament\Resources\Warehouse\Products\Schemas\ProductForm;
use App\Filament\Resources\Warehouse\Products\Tables\ProductsTable;
use App\Models\Warehouse\Product;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;
    protected static string|UnitEnum|null $navigationGroup = 'Warehouse';


    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
