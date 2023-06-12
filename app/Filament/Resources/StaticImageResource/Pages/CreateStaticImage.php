<?php

namespace App\Filament\Resources\StaticImageResource\Pages;

use App\Filament\Resources\StaticImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStaticImage extends CreateRecord
{
    protected static string $resource = StaticImageResource::class;
}
