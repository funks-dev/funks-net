<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Booking;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::info('Raw packet_ids before conversion:', ['packet_ids' => $data['packet_ids']]);

        if (isset($data['packet_ids']) && !is_array($data['packet_ids'])) {
            $data['packet_ids'] = array_map('trim', explode(',', $data['packet_ids']));
        }

        Log::info('Converted packet_ids to array:', ['packet_ids' => $data['packet_ids']]);

        return $data;
    }

    protected function handleRecordCreation(array $data): Booking
    {
        $booking = new Booking();
        $booking = $booking->saveWithPackets($data);
        return $booking;
    }
}
