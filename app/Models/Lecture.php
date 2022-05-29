<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $table = 'lectures';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function searchQuery($value)
    {
        return self::with('users')
            ->where('name', 'LIKE', "%{$value}%");
    }
}
