<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Packet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\Select::make('room_id')
                    ->label('Room')
                    ->relationship('room', 'name')
                    ->live()
                    ->required(),

                Forms\Components\Select::make('packet_ids')
                    ->label('Packets')
                    ->options(function (callable $get) {
                        $roomId = $get('room_id');
                        if (!$roomId) {
                            return [];
                        }

                        $room = Room::find($roomId);
                        if (!$room) {
                            return [];
                        }

                        return $room->packets()
                            ->withPivot('price')
                            ->get()
                            ->mapWithKeys(function ($packet) use ($room) {
                                return [
                                    $packet->id => $packet->name . ' (Rp ' . number_format($room->getPacketPrice($packet), 2) . ')'
                                ];
                            })
                            ->toArray();
                    })
                    ->multiple() // Pastikan `multiple` diaktifkan untuk mengirim array
                    ->required(),

                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->label('Start Time'),

                Forms\Components\DateTimePicker::make('end_time')
                    ->required()
                    ->label('End Time'),

                Forms\Components\TextInput::make('total_payment')
                    ->label('Total Payment')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash',
                        'credit_card' => 'Credit Card',
                        'bank_transfer' => 'Bank Transfer'
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('room.name')->label('Room'),
                Tables\Columns\TextColumn::make('packets')
                    ->label('Packets'),
                Tables\Columns\TextColumn::make('start_time')->label('Start Time'),
                Tables\Columns\TextColumn::make('end_time')->label('End Time'),
                Tables\Columns\TextColumn::make('total_payment')
                    ->label('Total Payment')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status'),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
