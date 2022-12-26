<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCountry extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'data_countries';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'iso2',
        'iso3'
    ];
}
