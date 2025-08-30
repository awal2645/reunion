<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'full_name',
        'nickname',
        'blood_group',
        'session',

        'contact_number',
        'email',
        'facebook_profile',
        'whatsapp_number',
        'present_address',
        'present_vill',
        'present_post_office',
        'present_thana',
        'present_district',
        'permanent_address',
        'permanent_vill',
        'permanent_post_office',
        'permanent_thana',
        'permanent_district',
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
        'courses_completed',
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
     * Get the payment shares associated with the user.
     */
    public function paymentShares()
    {
        return $this->hasMany(PaymentShare::class);
    }

    /**
     * Get the profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return Storage::url($this->photo_path);
        }
        
        return null;
    }

    /**
     * Check if the user has a profile photo.
     */
    public function hasProfilePhoto(): bool
    {
        return !is_null($this->photo_path);
    }

    /**
     * Determine if the user has already paid the base registration fee
     * in any PAID order. Handles first-time payments that may include guests.
     */
    public function hasPaidBaseRegistration(): bool
    {
        $paidOrders = $this->orders()->where('status', 'paid')->get();
        if ($paidOrders->isEmpty()) {
            return false;
        }

        $baseAmount = $this->getExpectedBaseAmount();

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
        // Check if user has paid the base registration fee
        if ($this->hasPaidBaseRegistration()) {
            return 'Paid';
        }
        
        // Check if user has any pending orders
        $pendingOrders = $this->orders()->where('status', 'pending')->get();
        if ($pendingOrders->count() > 0) {
            return 'Pending';
        }
        
        // If no orders at all, consider as unpaid
        if ($this->orders()->count() === 0) {
            return 'Unpaid';
        }
        
        // If has orders but none are pending and base fee not paid, consider as pending
        return 'Pending';
    }

    public function unpaidOrdersCount(): int
    {
        return $this->orders()->where('status', 'pending')->count();
    }

    /**
     * Get detailed payment status information
     */
    public function getDetailedPaymentStatus(): array
    {
        $totalOrders = $this->orders()->count();
        $pendingOrders = $this->orders()->where('status', 'pending')->count();
        $paidOrders = $this->orders()->where('status', 'paid')->count();
        $hasPaidBase = $this->hasPaidBaseRegistration();
        
        return [
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'paid_orders' => $paidOrders,
            'has_paid_base' => $hasPaidBase,
            'status' => $this->getPaymentStatus(),
            'base_amount_expected' => $this->getExpectedBaseAmount(),
        ];
    }

    /**
     * Get the expected base amount for this user's batch year
     */
    public function getExpectedBaseAmount(): int
    {
        if (!$this->session) {
            return 1000; // Default amount
        }
        
        $startYear = (int) explode('-', (string) $this->session)[0];
        if ($startYear >= 2018) {
            return 1000;
        } elseif ($startYear >= 2013) {
            return 1500;
        } else {
            return 2000;
        }
    }

    /**
     * Debug payment status for troubleshooting
     */
    public function debugPaymentStatus(): array
    {
        $paidOrders = $this->orders()->where('status', 'paid')->get();
        $pendingOrders = $this->orders()->where('status', 'pending')->get();
        
        $debug = [
            'user_id' => $this->id,
            'batch_year' => $this->batch_year,
            'expected_base_amount' => $this->getExpectedBaseAmount(),
            'total_orders' => $this->orders()->count(),
            'paid_orders_count' => $paidOrders->count(),
            'pending_orders_count' => $pendingOrders->count(),
            'has_paid_base' => $this->hasPaidBaseRegistration(),
            'payment_status' => $this->getPaymentStatus(),
        ];
        
        // Add order details for debugging
        $debug['paid_orders'] = $paidOrders->map(function($order) {
            return [
                'id' => $order->id,
                'amount' => $order->amount,
                'status' => $order->status,
                'guest_details' => $order->guest_details,
            ];
        })->toArray();
        
        $debug['pending_orders'] = $pendingOrders->map(function($order) {
            return [
                'id' => $order->id,
                'amount' => $order->amount,
                'status' => $order->status,
                'guest_details' => $order->guest_details,
            ];
        })->toArray();
        
        return $debug;
    }
}
