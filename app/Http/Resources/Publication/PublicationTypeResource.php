<?php

namespace App\Http\Resources\Publication;

use App\Models\Publication\PublicationType;

class PublicationTypeResource
{
    /**
     * @param  string $code
     *
     * @return \App\Models\Publication\PublicationType
     */
    public function findByCode(string $code)
    {
        return PublicationType::where('code', $code)->first();
    }

    /**
     * @return \App\Models\Publication\PublicationType
     */
    public function getAll()
    {
        return PublicationType::get();
    }
}
