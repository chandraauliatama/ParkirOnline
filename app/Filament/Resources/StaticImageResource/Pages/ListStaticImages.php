<?php

namespace App\Filament\Resources\StaticImageResource\Pages;

use App\Filament\Resources\StaticImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStaticImages extends ListRecords
{
    protected static string $resource = StaticImageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
