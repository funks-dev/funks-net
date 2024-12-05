<?php

namespace App\Filament\Resources\FoodDrinkResource\Pages;

use App\Filament\Resources\FoodDrinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoodDrinks extends ListRecords
{
    protected static string $resource = FoodDrinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
