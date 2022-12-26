<?php

namespace App\Models\Room;

use App\Models\Publication\Publication;
use App\Models\User;
use App\Models\User\UserRoom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'status_id',
        'title',
        'description',
        'avatar_url',
        'cover_url',
        'max_users',
        'price',
        'launch_at',
        'featured'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'launch_at' => 'datetime',
    ];

    /**
     * Get user owner from room
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get status from room
     *
     * @return \App\Models\Room\RoomStatus
     */
    public function status()
    {
        return $this->belongsTo(RoomStatus::class, 'status_id');
    }

    /**
     * Get users from room
     *
     * @return \App\Models\User\UserRoom
     */
    public function users()
    {
        return $this->hasMany(UserRoom::class, 'room_id');
    }

    /**
     * Get publication from room
     *
     * @return \App\Models\Publication\Publication
     */
    public function publications()
    {
        return $this->hasMany(Publication::class, 'room_id');
    }
}
