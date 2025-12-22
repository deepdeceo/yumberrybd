<?php

namespace App\Filament\Resources\Business\Zones\Schemas;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ZonesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Zone Details')
                    ->schema([
                        Select::make('city_id')
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: Mirpur, Banani'),

                        Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success'),
                    ])->columns(2),

                Section::make('Location Mapping')
                    ->description('Enter polygon coordinates for the zone boundary')
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
