<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
