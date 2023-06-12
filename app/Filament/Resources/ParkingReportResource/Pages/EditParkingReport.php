<?php

namespace App\Filament\Resources\ParkingReportResource\Pages;

use App\Filament\Resources\ParkingReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParkingReport extends EditRecord
{
    protected static string $resource = ParkingReportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
