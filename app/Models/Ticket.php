<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $with=(['event']);

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
