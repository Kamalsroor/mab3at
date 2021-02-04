<?php
namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Eloquent
{
    protected $fillable = [
                            'user_id',
                            'first_name',
                            'last_name',
                            'avatar'
                        ];
    protected $primaryKey = 'id';
    protected $table = 'profiles';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
