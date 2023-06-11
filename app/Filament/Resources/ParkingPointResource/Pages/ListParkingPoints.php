<?php

namespace App\Filament\Resources\ParkingPointResource\Pages;

use App\Filament\Resources\ParkingPointResource;
use App\Models\ParkingPoint;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Hash;

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
                    $platNumber = $data['plat_number'];
                    $parkingPoint = ParkingPoint::find($data['parking_point']);
                    $nowParking = ParkingPoint::where('plat_number', $platNumber)?->first();

                    // First Checking
                    if ($nowParking) {
                        return Notification::make()->danger()->title('Motor dengan plat nomor ini belum keluar!!')->send();
                    }

                    $oldUser = User::where('plat_number', $platNumber)?->first();

                    $parkingPoint->is_occupied = true;
                    $parkingPoint->plat_number = $platNumber;
                    $parkingPoint->save();


                    if ($oldUser) {
                        $oldUser->last_in = now();
                        $oldUser->park_location = $parkingPoint->id;
                        $oldUser->save();
                    } else {
                        User::create([
                            'username' => $platNumber,
                            'password' => Hash::make($platNumber),
                            'plat_number' => $platNumber,
                            'last_in' => now(),
                            'park_location' => $parkingPoint->id,
                        ]);
                    }

                    return Notification::make()->success()
                            ->title('Motor Berhasil Terdaftar, Silakan Menuju Titik ' . $parkingPoint->name)->send();
                })
        ];
    }
}
