<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    /*public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }*/

    public function versions(): HasMany
    {
        return $this->hasMany(PlatformVersion::class);
    }
}
