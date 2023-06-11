<?php

namespace App\Filament\Resources\ParkingPointResource\Pages;

use App\Filament\Resources\ParkingPointResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParkingPoint extends EditRecord
{
    protected static string $resource = ParkingPointResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
