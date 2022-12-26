<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationCommentLike extends Model
{
    use HasFactory;

        /**
     * table
     *
     * @var string
     */
    protected $table = 'publication_comments_likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment_id',
        'user_id'
    ];

    /**
     * Get comment from like
     *
     * @return App\Models\Publication\PublicationComment
     */
    public function comment()
    {
        return $this->belongsTo(PublicationComment::class, 'comment_id');
    }

    /**
     * Get user from like
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
