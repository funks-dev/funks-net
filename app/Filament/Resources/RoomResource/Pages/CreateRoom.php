<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info('Data before create:', $data);

        if (isset($data['packets'])) {
            $data['packets'] = collect($data['packets'])
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

            Log::info('Transformed packets data:', $data['packets']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        if (isset($this->data['room_packets'])) {
            $this->record->syncPackets($this->data['room_packets']);
        }
    }
}
