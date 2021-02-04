<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'label',
    ];
    protected $primaryKey = 'id';
    protected $table = 'permissions';
    use SoftDeletes;

    public function scopeFilterByName($q, $name = null)
    {
        if (!$name) {
            return $q;
        }

        return $q->where('name', 'like', '%' . $name . '%');
    }
}
