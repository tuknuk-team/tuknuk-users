<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNotificationType extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'data_notification_types';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
    ];
}
