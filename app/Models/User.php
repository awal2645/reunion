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
}
