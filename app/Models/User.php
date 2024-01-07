<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Need;

use App\Models\Report;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Add the 'role' property

    ];
    
    public static function createUser(array $data): User
    {
        // Create a new user with the provided data
        $user = self::create($data);

        return $user;
    }

    /**
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
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function needs()
    {
        return $this->hasMany(Need::class);
    }
    public function reports() {
        return $this->belongsToMany(Report::class, 'report_receivers');
    }
}
