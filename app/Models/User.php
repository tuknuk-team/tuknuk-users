<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Chat\Chat;
use App\Models\Data\DataGenre;
use App\Models\Publication\Publication;
use App\Models\Room\Room;
use App\Models\User\UserAddress;
use App\Models\User\UserBlocked;
use App\Models\User\UserCompliance;
use App\Models\User\UserFollow;
use App\Models\User\UserInterest;
use App\Models\User\UserNotification;
use App\Models\User\UserOnboarding;
use App\Models\User\UserPrivacy;
use App\Models\User\UserProfile;
use App\Models\User\UserRoom;
use App\Models\User\UserSecurity;
use App\Models\User\UserStatus;
use App\Models\User\UserTokenDevice;
use App\Notifications\Chat\MessageSentNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use AuthenticationLoggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'document_type',
        'document',
        'phone',
        'sponsor_id',
        'birth_date',
        'status_id',
        'genre_id'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *s
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return array
     */
    public function routeNotificationForOneSignal()
    {
        return [
            'tags' => [
                'key' => 'userId',
                'relation' => '=',
                'value' => (string)$this->id
            ]
        ];
    }

    /**
     * @param  array $data
     * @return void
     */
    public function sendNewMessageNotification(array $data)
    {
        $this->notify(new MessageSentNotification($data));
    }

    /**
     * Get the profile from user
     *
     * @return \App\Models\User\UserProfile
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    /**
     * Get the followers from user
     *
     * @return \App\Models\User\UserFollow
     */
    public function followers()
    {
        return $this->hasMany(UserFollow::class, 'user_follow_id', 'id');
    }

    /**
     * Get the following from user
     *
     * @return \App\Models\User\UserFollow
     */
    public function following()
    {
        return $this->hasMany(UserFollow::class, 'user_id', 'id');
    }

    /**
     * Get the address from user
     *
     * @return \App\Models\User\UserAddress
     */
    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }

    /**
     * Get the interests from user
     *
     * @return \App\Models\User\UserInterest
     */
    public function interests()
    {
        return $this->hasMany(UserInterest::class, 'user_id', 'id');
    }

    /**
     * Get the notifications from user
     *
     * @return \App\Models\User\UserNotification
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id', 'id');
    }

    /**
     * Get the security from user
     *
     * @return \App\Models\User\UserSecurity
     */
    public function security()
    {
        return $this->hasOne(UserSecurity::class, 'user_id', 'id');
    }

    /**
     * Get the onboarding from user
     *
     * @return \App\Models\User\UserOnboarding
     */
    public function onboarding()
    {
        return $this->hasOne(UserOnboarding::class, 'user_id', 'id');
    }

    /**
     * Get the publications from user
     *
     * @return \App\Models\Publication\Publication
     */
    public function publications()
    {
        return $this->hasMany(Publication::class, 'user_id', 'id');
    }

    /**
     * Get the genre from user
     *
     * @return \App\Models\Data\DataGenre
     */
    public function genre()
    {
        return $this->hasOne(DataGenre::class, 'id', 'genre_id');
    }

    /**
     * Get the compliance from user
     *
     * @return \App\Models\User\UserCompliance
     */
    public function compliance()
    {
        return $this->hasOne(UserCompliance::class, 'user_id', 'id');
    }

    /**
     * Get the privacy from user
     *
     * @return \App\Models\User\UserPrivacy
     */
    public function privacy()
    {
        return $this->hasMany(UserPrivacy::class, 'user_id', 'id');
    }

    /**
     * Get the users blocked from user
     *
     * @return \App\Models\User\UserBlocked
     */
    public function usersBlocked()
    {
        return $this->hasMany(UserBlocked::class, 'user_id', 'id');
    }

    /**
     * Get the rooms from user
     *
     * @return \App\Models\User\UserRoom
     */
    public function rooms()
    {
        return $this->hasMany(UserRoom::class, 'user_id', 'id');
    }

    /**
     * Get the rooms created from user
     *
     * @return \App\Models\Room\Room
     */
    public function roomsCreated()
    {
        return $this->hasMany(Room::class, 'user_id', 'id');
    }

    /**
     * Get the chats from user
     *
     * @return \App\Models\Chat\Chat
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'created_by', 'id');
    }

    /**
     * Get status
     *
     * @return \App\Models\User\UserStatus
     */
    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    /**
     * Get token device
     *
     * @return \App\Models\User\UserTokenDevice
     */
    public function tokenDevice()
    {
        return $this->hasOne(UserTokenDevice::class, 'user_id', 'id');
    }


}
