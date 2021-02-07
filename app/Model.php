<?php

namespace App;

use Illuminate\Database\Eloquent\Model as OldModel;

class Model extends OldModel
{
    public function scopeGetDeleted($q, $deleted = false)
    {
        if ($deleted) {
            return $q->onlyTrashed();
        }

        return $q;
    }
}
