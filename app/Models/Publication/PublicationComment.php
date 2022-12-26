<?php

namespace App\Models\Publication;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationComment extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publication_id',
        'user_id',
        'comment',
        'comment_id_parent',
    ];

    /**
     * Get publication from comment
     *
     * @return App\Models\Publication\Publication
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    /**
     * Get user from comment
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get statistics from publication
     *
     * @return \App\Models\Publication\PublicationCommentStatistics
     */
    public function statistics()
    {
        return $this->hasOne(PublicationCommentStatistics::class, 'comment_id', 'id');
    }

    /**
     * Get the comments parent from comment
     *
     * @return \App\Models\Publication\PublicationComment
     */
    public function commentsParent()
    {
        return $this->hasMany(PublicationComment::class, 'comment_id_parent', 'id');
    }

    /**
     * Get the likes from publication
     *
     * @return \App\Models\Publication\PublicationCommentLike
     */
    public function likes()
    {
        return $this->hasMany(PublicationCommentLike::class, 'comment_id', 'id');
    }

}
