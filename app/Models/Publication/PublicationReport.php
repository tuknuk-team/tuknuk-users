<?php

namespace App\Models\Publication;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationReport extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publication_id',
        'user_id'
    ];

    /**
     * Get publication from Report
     *
     * @return App\Models\Publication\Publication
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    /**
     * Get user from Report
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
