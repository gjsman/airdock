<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlatformVersion extends Model
{
    use HasFactory;

    public function platforms(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    public function plugins(): BelongsToMany
    {
        return $this->belongsToMany(Plugin::class);
    }
}
