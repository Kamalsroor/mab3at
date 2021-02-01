<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'telephone', 'email', 'type'];
    protected $primaryKey = 'id';
    protected $table = 'customers';



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
