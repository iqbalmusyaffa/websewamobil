<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'member_tier',
        'member_points',
        'member_valid_thru',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'member_valid_thru' => 'date',
        ];
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class);
    }

    public function addPoints(int $amount, string $description, ?int $bookingId = null)
    {
        $this->member_points += $amount;
        
        // Auto-upgrade tier logic (prevent downgrade)
        $tierHierarchy = ['reguler' => 0, 'silver' => 1, 'gold' => 2, 'platinum' => 3];
        $currentTierLevel = $tierHierarchy[$this->member_tier] ?? 0;

        if ($this->member_points >= 15000 && $currentTierLevel < 3) {
            $this->member_tier = 'platinum';
        } elseif ($this->member_points >= 5000 && $currentTierLevel < 2) {
            $this->member_tier = 'gold';
        } elseif ($this->member_points >= 1000 && $currentTierLevel < 1) {
            $this->member_tier = 'silver';
        }

        $this->save();

        $this->pointHistories()->create([
            'booking_id' => $bookingId,
            'type' => 'earn',
            'amount' => $amount,
            'description' => $description,
        ]);
    }

    public function redeemPoints(int $amount, string $description, ?int $bookingId = null): bool
    {
        if ($this->member_points >= $amount) {
            $this->member_points -= $amount;
            
            // Downgrade logic if needed? Usually tiers don't downgrade upon spending points.
            // Some systems use "lifetime points" for tiers. Here we just deduct points but keep the tier.
            // Or maybe keep a separate column for lifetime points. Let's just deduct it and NOT downgrade.
            $this->save();

            $this->pointHistories()->create([
                'booking_id' => $bookingId,
                'type' => 'redeem',
                'amount' => $amount,
                'description' => $description,
            ]);

            return true;
        }

        return false;
    }
}
