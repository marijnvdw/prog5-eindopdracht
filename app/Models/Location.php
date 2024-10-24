<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
