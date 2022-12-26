<?php

namespace App\Models\User;

use App\Models\Room\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_room';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'type',
        'payment_hash',
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
     * Get room
     *
     * @return App\Models\Room\Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
