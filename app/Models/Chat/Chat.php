<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chat extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'is_private',
        'created_by',
        'avatar',
        'description',
    ];

    /**
     * Get creator from chat
     *
     * @return \App\Models\User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the messages from chat
     *
     * @return \App\Models\Chat\ChatMessage
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id');
    }

    /**
     * Get the participants from chat
     *
     * @return \App\Models\Chat\ChatParticipant
     */
    public function participants()
    {
        return $this->hasMany(ChatParticipant::class, 'chat_id', 'id');
    }

    /**
     * Get the last message from chat
     *
     * @return \App\Models\Chat\ChatMessage
     */
    public function lastMessage()
    {
        return $this->hasOne(ChatMessage::class, 'chat_id', 'id')->latest('updated_at');
    }

    /**
     * Scope a query to only include from user participate
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int $user_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasParticipant($query, int $user_id)
    {
        return $query->whereHas('participants', function($q) use($user_id){
            $q->where('user_id', $user_id);
        });
    }
}
