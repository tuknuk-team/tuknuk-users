<?php

namespace App\Models\User;

use App\Models\Data\DataNotificationChannel;
use App\Models\Data\DataNotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_notification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'notification_type_id',
        'notification_channel_id',
        'status'
    ];

    /**
     * Get the User
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the Notification Type
     *
     * @return \App\Models\Data\DataNotificationType
     */
    public function notificationType()
    {
        return $this->hasOne(DataNotificationType::class, 'id', 'notification_type_id');
    }

    /**
     * Get the Notification Channel
     *
     * @return \App\Models\Data\DataNotificationChannel
     */
    public function notificationChannel()
    {
        return $this->hasOne(DataNotificationChannel::class, 'id', 'notification_channel_id');
    }
}
