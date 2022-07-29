<?php

namespace App\Filament\Resources\MarkResource\Pages;

use App\Filament\Resources\MarkResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMark extends CreateRecord
{
    protected static string $resource = MarkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
