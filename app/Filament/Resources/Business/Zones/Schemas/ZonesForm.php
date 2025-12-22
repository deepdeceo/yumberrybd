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
                    ->dehydrateStateUsing(function ($state) {
                        if (empty($state)) {
                            return null;
                        }

                        // If single point, create a small polygon around it
                        if (is_array($state) && isset($state['lat'], $state['lng'])) {
                            $lat = (float)$state['lat'];
                            $lng = (float)$state['lng'];
                            $offset = 0.005; // Small offset for polygon

                            $coordinates = [
                                [$lng - $offset, $lat - $offset],
                                [$lng + $offset, $lat - $offset],
                                [$lng + $offset, $lat + $offset],
                                [$lng - $offset, $lat + $offset],
                                [$lng - $offset, $lat - $offset], // Close the polygon
                            ];

                            return [
                                'type' => 'Polygon',
                                'coordinates' => [$coordinates],
                            ];
                        }

                        // If array of points, process as polygon
                        if (is_array($state)) {
                            $coordinates = [];

                            foreach ($state as $point) {
                                if (is_array($point) && isset($point['lat'], $point['lng'])) {
                                    $coordinates[] = [(float)$point['lng'], (float)$point['lat']];
                                } elseif (is_array($point) && count($point) === 2) {
                                    $coordinates[] = [(float)$point[1], (float)$point[0]];
                                }
                            }

                            if (empty($coordinates)) {
                                return null;
                            }

                            return [
                                'type' => 'Polygon',
                                'coordinates' => [$coordinates],
                            ];
                        }

                        return null;
                    }),
            ]);
    }
}
