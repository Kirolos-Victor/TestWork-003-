<?php
namespace App\Models;

use App\Traits\Tokenable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Tokenable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saveUser($request)
    {
        return self::create($request->all());
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }

    public function searchQuery($value)
    {
        return self::with('lectures')
            ->where('name', 'LIKE', "%{$value}%")
            ->orWhere('email', 'LIKE', "%{$value}%");
    }
}
