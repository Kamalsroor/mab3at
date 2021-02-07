<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    //
    protected $fillable = ['name', 'address', 'phone', 'telephone', 'user_id'];
    protected $primaryKey = 'id';
    protected $table = 'branches';
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    
    public function scopeCreatedAtDateBetween($q, $dates)
    {
        if ((! $dates['start_date'] || ! $dates['end_date']) && $dates['start_date'] <= $dates['end_date']) {
            return $q;
        }
        return $q->where('created_at', '>=', getStartOfDate($dates['start_date']))->where('created_at', '<=', getEndOfDate($dates['end_date']));
    }

    public function scopeFilterByname($q, $name = null)
    {
        if (! $name) {
            return $q;
        }

        return $q->where('name', 'like', '%'.$name.'%');
    }
    
    public function scopeFilterByAddress($q, $address = null)
    {
        if (! $address) {
            return $q;
        }

        return $q->where('address', 'like', '%'.$address.'%');
    }

 

}
