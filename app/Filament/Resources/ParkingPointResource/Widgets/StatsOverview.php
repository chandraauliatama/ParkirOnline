<?php

namespace App\Filament\Resources\ParkingPointResource\Widgets;

use App\Models\ParkingPoint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Titik Parkir', ParkingPoint::count()),
            Card::make('Parkir Terisi', ParkingPoint::where('is_occupied', true)->count())
        ];
    }
}
