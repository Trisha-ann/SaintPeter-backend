<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customers extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $primaryKey = 'customers_id';

    protected $fillable = [
        'last_name',
        'first_name', 
        'address',
        'age',
        'gender',
        'birth_date',
        'death_date',
        'employee_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
