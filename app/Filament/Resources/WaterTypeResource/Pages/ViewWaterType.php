<?php

namespace App\Filament\Resources\WaterTypeResource\Pages;

use App\Filament\Resources\WaterTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWaterType extends ViewRecord
{
    protected static string $resource = WaterTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
