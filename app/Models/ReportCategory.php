<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportCategory extends Model
{

    protected $fillable = [
        'name',
        'image'
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
