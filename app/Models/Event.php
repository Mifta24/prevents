<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $with=(['organizer','tickets']);

    protected $fillable = [
        'organizer_id',
        'name',
        'slug',
        'description',
        'date',
        'location',
        'capacity',

    ];


    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

}
