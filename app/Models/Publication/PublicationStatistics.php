<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationStatistics extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publication_id',
        'views',
        'comments',
        'likes',
        'reports',
        'shared',
        'sended'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'publication_id'
    ];

    /**
     * Get publication from statistic
     *
     * @return App\Models\Publication\Publication
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}
