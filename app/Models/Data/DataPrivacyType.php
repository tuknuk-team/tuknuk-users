<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrivacyType extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'data_privacy_types';

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

    /**
     * Get the options connect from user
     *
     * @return \App\Models\Data\DataPrivacyTypeOptionConnect
     */
    public function privacyTypeOptionConnected()
    {
        return $this->hasOne(DataPrivacyTypeOptionConnect::class, 'privacy_type_id', 'id');
    }
}
