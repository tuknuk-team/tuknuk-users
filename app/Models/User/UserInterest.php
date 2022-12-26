<?php

namespace App\Models\User;

use App\Models\Data\DataInterest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users_interest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'interest_id',
    ];

    /**
     * Get user
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the Interest
     *
     * @return \App\Models\Data\DataInterest
     */
    public function interest()
    {
        return $this->hasOne(DataInterest::class, 'id', 'interest_id');
    }
}
