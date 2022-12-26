<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrivacyTypeOptionConnect extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'data_privacy_types_connected';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'privacy_type_id',
        'privacy_type_option_id',
        'is_default'
    ];

    /**
     * Get the Privacy Type
     *
     * @return \App\Models\Data\DataPrivacyType
     */
    public function privacyType()
    {
        return $this->hasOne(DataPrivacyType::class, 'id', 'privacy_type_id');
    }

    /**
     * Get the Privacy Type Option
     *
     * @return \App\Models\Data\DataPrivacyTypeOption
     */
    public function privacyTypeOption()
    {
        return $this->hasOne(DataPrivacyTypeOption::class, 'id', 'privacy_type_option_id');
    }
}
