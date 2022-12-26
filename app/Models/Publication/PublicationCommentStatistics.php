<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationCommentStatistics extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_comments_statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'comment_id',
        'likes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'comment_id'
    ];

    /**
     * Get comment from statistic
     *
     * @return App\Models\Publication\PublicationComment
     */
    public function comment()
    {
        return $this->belongsTo(PublicationComment::class, 'comment_id');
    }
}
