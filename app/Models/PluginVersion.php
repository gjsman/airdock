<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PluginVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'plugin_id',
        'revoked',
        'file_path'
    ];

    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class);
    }
}
