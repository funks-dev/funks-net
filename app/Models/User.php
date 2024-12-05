<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (!$this->is_admin || !$this->hasVerifiedEmail()) {
            // Menggunakan Filament Notification
            Notification::make()
                ->danger()
                ->title('Access Denied')
                ->body('You are not authorized to access this area.')
                ->send();

            // Return false untuk mencegah akses
            return false;
        }

        return true;
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
