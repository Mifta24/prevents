<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

   

    protected $fillable = [
        'registration_id',
        'amount',
        'payment_method',
        'payment_date',
        'status',

    ];


    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }
}
