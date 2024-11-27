<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Get the current packets directly from the relationship
        $data['packet_ids'] = $this->record->packets()
            ->pluck('packets.id')
            ->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure packet_ids is an array
        if (isset($data['packet_ids']) && !is_array($data['packet_ids'])) {
            $data['packet_ids'] = explode(',', $data['packet_ids']);
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update basic booking data
        $record->update($data);

        // Sync the packets relationship
        if (isset($data['packet_ids'])) {
            $record->packets()->sync($data['packet_ids']);
        }

        return $record;
    }
}
