<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    protected $fillable = [
                            'name'
                        ];
    protected $primaryKey = 'id';
    protected $table = 'roles';
    use SoftDeletes;

    public function getDetailAttribute()
    {
        return ucfirst($this->name);
    }

    public function scopeFilterByName($q, $name = null)
    {
        if (! $name) {
            return $q;
        }

        return $q->where('name', 'like', '%'.$name.'%');
    }
}
