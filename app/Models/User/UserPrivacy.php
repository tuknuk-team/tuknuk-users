<?php

namespace App\Models\User;

use App\Models\Data\DataPrivacyType;
use App\Models\Data\DataPrivacyTypeOption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrivacy extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_privacy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'privacy_type_id',
        'privacy_type_option_id'
    ];

    /**
     * Get the User
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the Privacy Type
     *
     * @return \App\Models\Data\DataPrivacyType
     */
    public function privacyType()
    {
        return $this->belongsTo(DataPrivacyType::class, 'privacy_type_id', 'id');
    }

    /**
     * Get the Privacy Type Option
     *
     * @return \App\Models\Data\DataPrivacyTypeOption
     */
    public function privacyTypeOption()
    {
        return $this->belongsTo(DataPrivacyTypeOption::class, 'privacy_type_option_id', 'id');
    }
}
