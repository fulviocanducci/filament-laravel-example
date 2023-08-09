<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [     
            Actions\ViewAction::make()->icon('heroicon-m-viewfinder-circle'),       
            Actions\DeleteAction::make()->icon('heroicon-m-trash'),
        ];
    }
}
