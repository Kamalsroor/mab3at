<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
