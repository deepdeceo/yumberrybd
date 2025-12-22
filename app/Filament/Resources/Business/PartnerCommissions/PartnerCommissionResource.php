<?php

namespace App\Filament\Resources\Business\PartnerCommissions;

use App\Filament\Resources\Business\PartnerCommissions\Pages\CreatePartnerCommission;
use App\Filament\Resources\Business\PartnerCommissions\Pages\EditPartnerCommission;
use App\Filament\Resources\Business\PartnerCommissions\Pages\ListPartnerCommissions;
use App\Filament\Resources\Business\PartnerCommissions\Schemas\PartnerCommissionForm;
use App\Filament\Resources\Business\PartnerCommissions\Tables\PartnerCommissionsTable;
use App\Models\Business\PartnerFlatRate;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerCommissionResource extends Resource
{
    protected static ?string $model = PartnerFlatRate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CreditCard;
    protected static string|UnitEnum|null $navigationGroup = 'Business';


    public static function form(Schema $schema): Schema
    {
        return PartnerCommissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerCommissionsTable::configure($table);
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
            'index' => ListPartnerCommissions::route('/'),
            'create' => CreatePartnerCommission::route('/create'),
            'edit' => EditPartnerCommission::route('/{record}/edit'),
        ];
    }
}
