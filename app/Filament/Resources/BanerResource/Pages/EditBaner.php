<?php

namespace App\Filament\Resources\BanerResource\Pages;

use App\Filament\Resources\BanerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaner extends EditRecord
{
    protected static string $resource = BanerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
