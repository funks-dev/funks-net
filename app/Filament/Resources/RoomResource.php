<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use App\Models\Packet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Room Name'),

                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('remaining_capacity', $state);
                    }),

                Forms\Components\TextInput::make('remaining_capacity')
                    ->required()
                    ->numeric()
                    ->label('Remaining Capacity')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $livewire) {
                        $livewire->record?->updateRemainingCapacity((int) $state);
                    }),

                Forms\Components\Section::make('Packet Prices')
                    ->schema([
                        Forms\Components\Repeater::make('room_packets')
                            ->label(false)
                            ->schema([
                                Forms\Components\Select::make('packet_id')
                                    ->label('Packet')
                                    ->options(Packet::query()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->distinct()
                                    ->preload(),

                                Forms\Components\TextInput::make('price')
                                    ->label('Price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->minValue(0),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Packet Price')
                            ->reorderableWithButtons()
                            ->deletable(true)
                            ->defaultItems(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Room Name'),
                Tables\Columns\TextColumn::make('capacity')->label('Capacity'),
                Tables\Columns\TextColumn::make('remaining_capacity')->label('Remaining Capacity'),
                Tables\Columns\TextColumn::make('packets')->label('Packets and Prices')->formatStateUsing(function ($state, $record) {
                    return $record->packets->map(function ($packet) use ($record) {
                        $roomPacket = $record->roomPackets->where('packet_id', $packet->id)->first();
                        return "{$packet->name}: Rp " . number_format($roomPacket?->price ?? 0, 2);
                    })->implode(', ');
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }

    public static function saving(array $data): array
    {
        $data['room_packets'] = collect($data['room_packets'] ?? [])
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

        return $data;
    }

    public static function updated(Resource $record, array $data): void
    {
        $record->syncPackets($data['room_packets']);
    }
}
