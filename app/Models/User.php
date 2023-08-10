<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE = [
        1 => 'Supervisor',
        2 => 'Employee',
        3 => 'Marketing',
        4 => 'Engineering',
        5 => 'Design',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'days',
        'sick_days',
        'role',
        'password',
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
    ];

    public function getIsAdminAttribute(): bool
    {
        return (int)$this->role === 1;
    }

    public function getCurrentYearAttribute(){
        return $this->periods()->where('year', date('Y'))->first();
    }

    public function getNameAttribute(): string {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function applications()
    {
        return $this->hasMany(Application::class)->orderBy('created_at', 'desc')->currentYear();
    }

    public function periods(){
        return $this->hasMany(Period::class);
    }
}
