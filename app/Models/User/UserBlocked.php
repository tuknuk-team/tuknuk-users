<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBlocked extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_blocked';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_blocked_id'
    ];

    /**
     * Get user
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get user blocked
     *
     * @return App\Models\User
     */
    public function userBlocked()
    {
        return $this->belongsTo(User::class, 'user_blocked_id');
    }
}
