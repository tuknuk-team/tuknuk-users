<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationDiscover extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_discover';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publication_id',
        'title',
        'description',
        'image',
        'embed',
        'link'
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
     * Get publication from comment
     *
     * @return App\Models\Publication\Publication
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}
