<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 */
class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'date:d.m.Y H:i:s',
        'updated_at' => 'date:d.m.Y H:i:s',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
