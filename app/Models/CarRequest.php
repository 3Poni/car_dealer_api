<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarRequest extends Model
{
    protected $fillable = [
        'car_id',
        'credit_program_id',
        'initial_payment',
        'loan_term',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function creditProgram()
    {
        return $this->belongsTo(CreditProgram::class);
    }
}
