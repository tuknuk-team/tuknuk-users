<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'chats_messages';

    protected $touches = ['chat'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'archive_type',
        'archive_url',
        'reply_chat_message_id',
        'forward_chat_message_id'
    ];

    /**
     * Get chat from chat message
     *
     * @return \App\Models\Chat\Chat
     */
    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    /**
     * Get user from chat message
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
