<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompliance extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_compliance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status_id',
        'archives',
        'message',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'archives' => 'array'
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
     * Get status
     *
     * @return App\Models\User\UserComplianceStatus
     */
    public function status()
    {
        return $this->belongsTo(UserComplianceStatus::class, 'status_id');
    }
}
