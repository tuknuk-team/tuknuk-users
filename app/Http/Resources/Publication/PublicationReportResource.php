<?php

namespace App\Http\Resources\Publication;

use App\Models\Publication\PublicationReport;
use App\Models\User;

class PublicationReportResource
{
    /**
     * @param int $id
     *
     * @return \App\Models\Publication\PublicationReport
     */
    public function findById(string $id)
    {
        return PublicationReport::where('id', $id)->first();
    }

    /**
     * @param  \App\Models\User $user
     * @param  string $publication_uuid
     *
     * @return bool
     * @throws \Exception
     */
    public function report(User $user, string $publication_uuid)
    {

        $publication = (new PublicationResource())->findByUuid($publication_uuid);

        if(!$publication){
            throw new \Exception('Publicação não encontrada.', 403);
        }

        if($publication->reports()->where('user_id', $user->id)->first()){
            throw new \Exception('Você já denunciou esta publicação.', 403);
        }

        return $publication->reports()->create([
            'user_id' => $user->id
        ]);
    }
}
