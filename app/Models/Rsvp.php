<?php

namespace App\Models;

use Database\Factories\RsvpFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rsvp extends Model
{
    /** @use HasFactory<RsvpFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'caller_name',
        'unique_id',
        'phone',
        'attendance',
        'guests',
        'note',
    ];

    protected static function booted(): void
    {
        static::creating(function (Rsvp $rsvp) {
            if (empty($rsvp->unique_id)) {
                $rsvp->unique_id = fake()->unique()->bothify('????????####');
            }
        });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
