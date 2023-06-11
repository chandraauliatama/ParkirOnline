<?php

namespace App\Filament\Resources\ParkingPointResource\Pages;

use App\Filament\Resources\ParkingPointResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParkingPoints extends ListRecords
{
    protected static string $resource = ParkingPointResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
