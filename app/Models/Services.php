<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Services extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_vehicle',
        'service_image',
        'coffin_type',
        'coffin_image',
        'burial_location',
        'burial_image',
        'plan_id',
    ];

    protected $casts = [
        'service_image' => 'string', // Ensure it's casted to string
        'coffin_image' => 'string',
        'burial_image' => 'string',
    ];
}
