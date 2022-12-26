<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatParticipant extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'chats_participants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'user_id',
    ];

    /**
     * Get chat from chat participant
     *
     * @return \App\Models\Chat\Chat
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    /**
     * Get user from chat participant
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
