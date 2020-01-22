<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $fillable = ['name', 'address', 'phone', 'telephone', 'user_id'];
    protected $primaryKey = 'id';
    protected $table = 'branches';


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
