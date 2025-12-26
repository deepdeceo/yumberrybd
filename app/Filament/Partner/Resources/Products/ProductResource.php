<?php

namespace App\Filament\Partner\Resources\Products;

use App\Filament\Partner\Resources\Products\Pages\CreateProduct;
use App\Filament\Partner\Resources\Products\Pages\EditProduct;
use App\Filament\Partner\Resources\Products\Pages\ListProducts;
use App\Filament\Partner\Resources\Products\Schemas\ProductForm;
use App\Filament\Partner\Resources\Products\Tables\ProductsTable;
use App\Models\Warehouse\PartnerProduct;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = PartnerProduct::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag

;


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
