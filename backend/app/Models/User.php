<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $email
 * @property string|null $login
 * @property string|null $password
 * @property Role|null $role
 * @property int|null two_factor_code
 * @property Carbon|null two_factor_expires_at
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'login',
        'password',

        'role_id',

        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'role_id',
        'remember_token',
        'two_factor_code',
        'two_factor_expires_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'date:d.m.Y H:i:s',
        'two_factor_expires_at' => 'date:d.m.Y H:i:s',
        'created_at' => 'date:d.m.Y H:i:s',
        'updated_at' => 'date:d.m.Y H:i:s',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_id');
    }

    public function createdTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'creator_id');
    }
}
