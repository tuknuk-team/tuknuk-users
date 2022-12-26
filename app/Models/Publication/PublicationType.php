<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'publications_type';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name'
    ];

}
