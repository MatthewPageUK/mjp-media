<?php

namespace App\Models;

use App\Facades\UserStorage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

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
        'directory',
        'active',
        'capacity',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the users disk
     *
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function getDiskAttribute()
    {
        return Storage::build([
            'driver' => 'local',
            'root' => Storage::path($this->storagePath),
        ]);
    }

    public function getCapacityBytesAttribute()
    {
        return $this->capacity * 1024 * 1024;
    }
    /**
     * Get the total number of files
     *
     * @return int
     */
    public function getTotalFilesAttribute(): int
    {
        return UserStorage::getTotalFiles($this);
    }

    /**
     * Percentage of capacity used.
     *
     * @return int
     */
    public function getCapacityUsedPercentAttribute(): int
    {
        $percent = ceil(($this->capacityUsed / 1024 / 1024) / $this->capacity * 100);
        return $percent;
    }

    /**
     * Total capacity used.
     *
     * @return float
     */
    public function getCapacityUsedAttribute(): float
    {
        return UserStorage::getUsedSpace($this);
    }

    /**
     * Capacity remaining.
     *
     * @return float
     */
    public function getCapacityRemainingAttribute(): float
    {
        return $this->capacityBytes - $this->capacityUsed;
    }

    /**
     * The storage path for this user
     *
     * @return string
     */
    public function getStoragePathAttribute(): string
    {
        return sprintf('%s/%s', UserStorage::getBaseDirectory(), $this->directory);
    }

    /**
     * Is the user an admin?
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin ? true : false;
    }

    /**
     * Is the user active?
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Scope the query to 'users' (not admins)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsers($query): Builder
    {
        return $query->where('is_admin', false);
    }

    /**
     * Scope the query to 'admins' (not users)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmins($query): Builder
    {
        return $query->where('is_admin', true);
    }

    /**
     * Scope the query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->where('active', true);
    }


}
