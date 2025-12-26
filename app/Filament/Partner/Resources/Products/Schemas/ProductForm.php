<?php

namespace App\Filament\Partner\Resources\Products\Schemas;

use App\Models\UserManagement\Partner;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Basic Info')
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
                            ->disk('public')
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

                        Toggle::make('status')
                            ->label('Is Active')
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Featured Product'),

                        TextInput::make('user_id')
                            ->default(fn() => auth()->guard('web')->id()) // আপনি যদি নরমাল ইউজার হন তবে 'web' guard ব্যবহার করুন
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('partner_id')
                            ->default(function () {
                                $authUserId = auth()->guard('web')->id(); // সরাসরি লগইন করা ইউজারের আইডি
                                return Partner::where('user_id', $authUserId)->value('id');
                            })
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                    ]),


            ]);
    }
}
