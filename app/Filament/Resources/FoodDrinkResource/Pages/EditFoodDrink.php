<?php

namespace App\Filament\Resources\FoodDrinkResource\Pages;

use App\Filament\Resources\FoodDrinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoodDrink extends EditRecord
{
    protected static string $resource = FoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
