<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'payment_method',
        'transaction_id',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the payment share.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
