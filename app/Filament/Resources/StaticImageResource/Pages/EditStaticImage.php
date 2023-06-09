<?php

namespace App\Filament\Resources\StaticImageResource\Pages;

use App\Filament\Resources\StaticImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStaticImage extends EditRecord
{
    protected static string $resource = StaticImageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
