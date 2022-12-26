<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSecurity extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_security';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'google_2fa',
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
}
