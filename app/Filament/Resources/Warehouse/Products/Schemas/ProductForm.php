<?php

namespace App\Filament\Resources\Warehouse\Products\Schemas;

use App\Models\Business\Cities;
use App\Models\Business\Zones;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Container\Attributes\Auth;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Detials')
                    ->description('Enter the product details below.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->placeholder('Product title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn($state, callable $set) =>
                                $set('slug', str($state)->slug())
                            ),
                        TextInput::make('slug')
                            ->required()
                            ->unique('products', 'slug', ignoreRecord: true)
                            ->readOnly()
                            ->helperText('Auto-generated from title'),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('thumbnail')
                            ->label('Feature Image')
                            ->image()
                            ->directory('products/thumbnails')
                            ->imageEditor() // v4 features
                            ->required(),

                        FileUpload::make('images')
                            ->label('Gallery Images')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('products/gallery')
                            ->panelLayout('grid'),
                    ]),

                Section::make('Product Pricing')
                    ->description('Provide a detailed Pricing of the product.')
                    ->schema([
                        TextInput::make('buying_price')
                            ->numeric()
                            ->prefix('৳')
                            ->required(),

                        TextInput::make('selling_price')
                            ->numeric()
                            ->prefix('৳')
                            ->required(),

                        Grid::make(2)
                            ->schema([
                                Select::make('discount_type')
                                    ->options([
                                        'flat' => 'Flat',
                                        'percent' => 'Percent',
                                    ]),
                                TextInput::make('discount_amount')
                                    ->numeric(),
                            ]),

                        Select::make('cities_id')
                            ->label('Select Cities')
                            ->multiple() // JSON array save korbe
                            ->options(Cities::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live() // Eti dorkar jate City change hole Zone update hoy
                            ->afterStateUpdated(fn(callable $set) => $set('zones_id', [])), // City change hole Zone reset hoye jabe

                        Select::make('zones_id')
                            ->label('Select Zones')
                            ->multiple() // JSON array save korbe
                            ->searchable()
                            ->preload()
                            ->options(function (Get $get) {
                                $selectedCities = $get('cities_id'); // Selected city IDs niye asha

                                if (! $selectedCities) {
                                    return []; // City select na korle Zone faka thakbe
                                }

                                // Selected city gular upor vitti kore zones filter kora
                                return Zones::whereIn('city_id', $selectedCities)
                                    ->pluck('name', 'id');
                            })
                            ->disabled(fn(Get $get) => empty($get('cities_id'))), // City select na kora porjonto disable thakbes
                    ]),

                Section::make('Inventory')
                    ->schema([
                        TextInput::make('qty')
                            ->label('Stock Quantity')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        TextInput::make('sku')
                            ->label('SKU Code')
                            ->unique(ignoreRecord: true),
                        Toggle::make('status')
                            ->label('Is Active')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Featured Product'),

                        // Hidden field to auto-save the creator
                        TextInput::make('user_id')
                            ->default(fn() => auth()->guard('admin')->id())
                            ->hidden()
                            ->dehydrated(),
                    ]),


            ]);
    }
}
