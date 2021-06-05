<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if logged-in user is admin
     */
    public function isAdmin()
    {
        return ($this->is_admin) ? 1 : 0;
    }

    /**
     * Determine if logged-in user is notadmin
     */
    public function isNotAdmin()
    {
        return !$this->isAdmin();
    }

    /**
     * User has many tests
     */
    public function tests()
    {
        return $this->hasMany(UserTest::class)->completed()->latest();
    }

    /**
     * User has one active tests
     */
    public function activeTest()
    {
        return $this->hasOne(UserTest::class)->active();
    }

    public function scopeOrdinary($query)
    {
        return $query->where('is_admin', 0);
    }
}
