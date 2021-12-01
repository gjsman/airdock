<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PluginVersion extends Model
{
    use HasFactory;

    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class);
    }
}
