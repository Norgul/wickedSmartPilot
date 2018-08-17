<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    protected $dates = [
        'verified_at',
    ];

    public function requestSignature()
    {
        $this->signature = str_random(40);

        $this->save();

        return $this->signature;
    }

    public function isVerified()
    {
        return !is_null($this->verified_at);
    }

    public function verifySignature($signature)
    {
        return ($signature === $this->signature);
    }

    public function verifyAccount()
    {
        $this->verified_at = now();
        $this->save();

        return $this->verified_at;
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('verified_at');
    }

    public function scopeNonVerified($query)
    {
        return $query->whereNull('verified_at');
    }
}
