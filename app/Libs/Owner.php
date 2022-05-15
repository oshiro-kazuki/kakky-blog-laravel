<?php

namespace App\Libs;

use App\Model\Owners;

class Owner
{
    public function getOwnerByOwnerIdToName(string $owner_id)
    {
        return Owners::where('owner_id', $owner_id)
        ->select('name')
        ->first();
    }

    public function getOwnerByOwnerIdToEmail(string $owner_id)
    {
        return Owners::where('owner_id', $owner_id)
        ->select('email')
        ->first();
    }
}
?>