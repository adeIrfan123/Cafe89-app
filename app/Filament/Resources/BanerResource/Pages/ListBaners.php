<?php

namespace App\Filament\Resources\BanerResource\Pages;

use App\Filament\Resources\BanerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaners extends ListRecords
{
    protected static string $resource = BanerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
