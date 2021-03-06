<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /*
     * public function platform(): BelongsTo
     * {
     *     return $this->belongsTo(Platform::class);
     * }
     */

}
