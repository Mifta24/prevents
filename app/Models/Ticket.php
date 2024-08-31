<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;


    protected $fillable = [
        'event_id',
        'type',
        'price',
        'available_quantity',


    ];


    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
