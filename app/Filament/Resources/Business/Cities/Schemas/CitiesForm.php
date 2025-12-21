<?php

namespace App\Filament\Resources\Business\Cities\Schemas;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CitiesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // বাম পাশে নাম এবং স্ট্যাটাস
                Section::make('City Details')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter city name'),

                        Grid::make(2)->schema([
                            TextInput::make('state')
                                ->required(),
                            TextInput::make('country')
                                ->default('Bangladesh')
                                ->required(),
                        ]),

                        Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success'),
                    ]),

                // ডান পাশে ম্যাপ এরিয়া সিলেকশন
                Section::make('City Boundary (Map)')
                    ->columnSpan(1) // সেকশনটিকে পুরো উইডথ দিতে এটি নিশ্চিত করুন
                    ->schema([
                        Map::make('location')
                            ->label('Select Area Boundary')
                            ->columnSpanFull()
                            ->defaultLocation(23.8103, 90.4125)
                            ->showMarker(false)
                            ->geoMan(true)
                            ->geoManEditable(true)
                            ->drawPolygon(true)
                            ->editPolygon(true)
                            ->deleteLayer(true)
                            ->setColor('#ff5722')
                            ->setFilledColor('#ff5722')
                            ->extraAttributes([
                                'style' => 'height: 500px;',
                            ])
                            ->extraControl([
                                'zoomControl' => true,
                                'fullscreenControl' => true,
                            ])
                    ]),

            ]);
    }
}
