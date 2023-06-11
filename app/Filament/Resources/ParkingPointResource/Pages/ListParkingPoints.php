<?php

namespace App\Filament\Resources\ParkingPointResource\Pages;

use App\Filament\Resources\ParkingPointResource;
use App\Models\ParkingPoint;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParkingPoints extends ListRecords
{
    protected static string $resource = ParkingPointResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('parkir')
                ->color('success')
                ->label('Motor Masuk')
                ->form([
                    TextInput::make('plat_number')
                        ->label('Plat Nomor')
                        ->required(),
                    Select::make('parking_point')
                        ->label('Titik Parkir')
                        ->required()
                        ->options(ParkingPoint::where('is_occupied', false)->pluck('name', 'id'))
                        ->searchable()
                ])
                ->action(function($data){
                    dd($data);
                })
        ];
    }
}
