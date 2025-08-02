<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'trxid',
        'guest_details',
    ];

    protected $casts = [
        'guest_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 