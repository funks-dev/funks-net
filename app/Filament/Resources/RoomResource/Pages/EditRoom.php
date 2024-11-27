<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load the room with its packets and pivot data
        $room = $this->record->load('packets');

        Log::info('Loading room data:', ['room_id' => $room->id]);

        // Map the packets to the correct format for the form
        $data['room_packets'] = $room->packets->map(function ($packet) {
            Log::info('Mapping packet:', [
                'packet_id' => $packet->id,
                'price' => $packet->pivot->price,
            ]);

            return [
                'packet_id' => $packet->id,
                'price' => $packet->pivot->price,
            ];
        })->toArray();

        Log::info('Transformed room packets data:', $data['room_packets']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::info('Received form data before save:', $data);

        if (isset($data['room_packets'])) {
            $data['room_packets'] = collect($data['room_packets'])
                ->map(function ($item) {
                    return [
                        'packet_id' => $item['packet_id'] ?? null,
                        'price' => $item['price'] ?? null,
                    ];
                })
                ->filter(function ($item) {
                    return !is_null($item['packet_id']) && !is_null($item['price']);
                })
                ->toArray();

            Log::info('Transformed room packets data before save:', $data['room_packets']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->data['room_packets'])) {
            Log::info('Saving room packets:', $this->data['room_packets']);
            $this->record->syncPackets($this->data['room_packets']);
        }
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Room updated')
            ->body('The room has been updated successfully.');
    }
}
