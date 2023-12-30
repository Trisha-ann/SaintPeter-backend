<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $guard ='employees';
    protected $primaryKey ='employee_id';

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'password',
    ];
}
