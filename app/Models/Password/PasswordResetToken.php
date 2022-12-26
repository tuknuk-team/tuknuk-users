<?php

namespace App\Models\Password;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'password_resets_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'expires_in',
        'password_updated',
    ];

    /**
     * Can use token
     *
     * @return bool
     */
    public function canUse()
    {
        if (strtotime(date('Y-m-d H:i:s')) > strtotime($this->expires_in) || $this->password_updated) {
            return false;
        }

        return true;
    }
}
