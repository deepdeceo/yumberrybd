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
