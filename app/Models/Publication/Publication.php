<?php

namespace App\Models\Publication;

use App\Models\Room\Room;
use App\Models\User;
use App\Observers\PublicationObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'type_id',
        'text',
        'is_private',
        'is_draft',
        'is_spoiler',
        'archive_url',
        'status_id',
        'room_id',
    ];

    /**
     * Scope a query to only include from users following
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int $user_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForFeed($query, int $user_id)
    {
        return  $query->leftJoin('users_follow', 'publications.user_id', '=', 'users_follow.user_follow_id')->where('users_follow.user_id', $user_id)->isPublished()
                      ->orWhere('publications.user_id', '=', $user_id)->isPublished();
    }

    /**
     * Scope a query to only include published
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPublished($query)
    {
        return $query->where('publications.is_draft', 0);
    }

    /**
     * Get user from publication
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get type from publication
     *
     * @return \App\Models\Publication\PublicationType
     */
    public function type()
    {
        return $this->belongsTo(PublicationType::class, 'type_id');
    }

    /**
     * Get status from publication
     *
     * @return \App\Models\Publication\PublicationStatus
     */
    public function status()
    {
        return $this->belongsTo(PublicationStatus::class, 'status_id');
    }

    /**
     * Get the likes from publication
     *
     * @return \App\Models\Publication\PublicationLike
     */
    public function likes()
    {
        return $this->hasMany(PublicationLike::class, 'publication_id', 'id');
    }

    /**
     * Get the saves from publication
     *
     * @return \App\Models\Publication\PublicationSave
     */
    public function saves()
    {
        return $this->hasMany(PublicationSave::class, 'publication_id', 'id');
    }

    /**
     * Get the reports from publication
     *
     * @return \App\Models\Publication\PublicationReport
     */
    public function reports()
    {
        return $this->hasMany(PublicationReport::class, 'publication_id', 'id');
    }

    /**
     * Get the comments from publication
     *
     * @return \App\Models\Publication\PublicationComment
     */
    public function comments()
    {
        return $this->hasMany(PublicationComment::class, 'publication_id', 'id');
    }

    /**
     * Get statistics from publication
     *
     * @return \App\Models\Publication\PublicationStatistics
     */
    public function statistics()
    {
        return $this->hasOne(PublicationStatistics::class, 'publication_id', 'id');
    }

    /**
     * Get room from publication
     *
     * @return \App\Models\Room\Room
     */
    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    /**
     * Get discover from publication
     *
     * @return \App\Models\Publication\PublicationDiscover
     */
    public function discover()
    {
        return $this->hasOne(PublicationDiscover::class, 'publication_id', 'id');
    }
}
