<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'nickname',
        'blood_group',
        'session',
        'batch_year',
        'contact_number',
        'email',
        'facebook_profile',
        'whatsapp_number',
        'present_address',
        'permanent_address',
        'country_of_residence',
        'city_of_residence',
        'occupation',
        'organization_name',
        'designation',
        'work_location',
        'marital_status',
        'spouse_name',
        'number_of_children',
        'photo_path',
        'favorite_memory',
        'accompanying_guests',
        'tshirt_size',
        'willing_to_volunteer',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'willing_to_volunteer' => 'boolean',
        'number_of_children' => 'integer',
        'accompanying_guests' => 'integer',
    ];

    /**
     * Get the children associated with the user.
     */
    public function children()
    {
        return $this->hasMany(Child::class);
    }

    /**
     * Get the orders associated with the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Determine if the user has already paid the base registration fee
     * in any PAID order. Handles first-time payments that may include guests.
     */
    public function hasPaidBaseRegistration(): bool
    {
        $paidOrders = $this->orders()->get();
        if ($paidOrders->isEmpty()) {
            return false;
        }

        $startYear = (int) explode('-', (string) $this->batch_year)[0];
        $baseAmount = $startYear >= 2018 ? 1000 : ($startYear >= 2013 ? 1500 : 2000);

        foreach ($paidOrders as $order) {
            $guestDetails = is_array($order->guest_details) ? $order->guest_details : [];
            $chargeableGuests = 0;
            foreach ($guestDetails as $guest) {
                if (isset($guest['age']) && (int) $guest['age'] > 5) {
                    $chargeableGuests++;
                }
            }
            $guestFees = $chargeableGuests * 1000;
            $expectedWithBase = $baseAmount + $guestFees;

            if ($order->amount === $expectedWithBase || ($guestFees === 0 && $order->amount === $baseAmount)) {
                return true;
            }
        }

        return false;
    }

    public function getPaymentStatus(): string
    {
        $pendingOrders = $this->orders()->where('status', 'pending')->get();
        return $pendingOrders->count() > 0 ? 'Pending' : 'Paid';
    }

    public function unpaidOrdersCount(): int
    {
        return $this->orders()->where('status', 'pending')->count();
    }
}
