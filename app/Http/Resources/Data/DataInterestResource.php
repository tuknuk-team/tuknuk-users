<?php

namespace App\Http\Resources\Data;

use App\Models\Data\DataInterest;

class DataInterestResource
{
    /**
     * @return \App\Models\Data\DataInterest
     */
    public function getBaseInterests()
    {
        return DataInterest::whereNull('child_id')->get();
    }

    /**
     * @return \App\Models\Data\DataInterest
     */
    public function getAllInterests()
    {
        return DataInterest::get();
    }
}
