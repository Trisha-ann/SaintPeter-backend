<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Plans extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'plan_image',
        'plan_name',
        'plan_type',
        'plan_price',
    ];

    protected $casts = [
        'plan_image' => 'string', // Ensure it's casted to string
    ];
}
