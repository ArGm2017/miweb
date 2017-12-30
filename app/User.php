<?php

namespace App;

use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort(401, 'Esta acción no está autorizada.');
        }
        return $this->hasRole($roles) ||
        abort(401, 'Esta acción no está autorizada.');
    }
/**
 * Check multiple roles
 * @param array $roles
 */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
/**
 * Check one role
 * @param string $role
 */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
