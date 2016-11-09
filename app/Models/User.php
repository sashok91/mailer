<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const USER_ROLE_ADMIN = 'admin';
    const USER_ROLE_SUBSCRIBER = 'subscriber';
    const USER_STATUS_ACTIVE = 'active';
    const USER_STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'user';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function isAdmin()
    {
        return $this->role === self::USER_ROLE_ADMIN;
    }

    public function isSubscriber()
    {
        return $this->role === self::USER_ROLE_SUBSCRIBER;
    }

    public function scopeGetAdminsByRoleStatus($query, $role, $status)
    {
        return $query->where('role', '=', $role)
            ->where('status', '=', $status);
    }

    /**
     * Get all active admins
     * @param $query
     * @return mixed
     */
    public function scopeGetAdminsList($query)
    {
        return $query->getAdminsByRoleStatus(self::USER_ROLE_ADMIN, self::USER_STATUS_ACTIVE);
    }

    public function getFullName()
    {
        return trim($this->first_name) . ' ' .trim($this->middle_name) . ' ' . trim($this->last_name);
    }
}
