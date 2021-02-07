<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPreference extends Model
{
    protected $fillable = [];
    protected $primaryKey = 'id';
    protected $table = 'user_preferences';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
