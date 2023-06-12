<?php

namespace App\Filament\Resources\ParkingReportResource\Pages;

use App\Filament\Resources\ParkingReportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParkingReports extends ListRecords
{
    protected static string $resource = ParkingReportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Cetak Laporan')
                ->color('success'),
        ];
    }
}
