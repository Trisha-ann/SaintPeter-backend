<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Payments extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'customers_id',
        'plan_id',
        'employee_id',
        'purchased_payable',
        'amount_received',
        'balance',
        'payment_duration',
    ];
}
