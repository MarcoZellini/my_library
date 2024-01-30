<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'author', 'isbn', 'plot', 'total_readings'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
