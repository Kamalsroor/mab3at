<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'group_id', 
        'category_id', 
        'min_price', 
        'max_price', 
        'image',
        'parcode',
        'status',
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';


    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function scopeCreatedAtDateBetween($q, $dates)
    {
        if ((! $dates['start_date'] || ! $dates['end_date']) && $dates['start_date'] <= $dates['end_date']) {
            return $q;
        }
        return $q->where('created_at', '>=', getStartOfDate($dates['start_date']))->where('created_at', '<=', getEndOfDate($dates['end_date']));
    }

    public function scopeFilterByName($q, $name = null)
    {
        if (! $name) {
            return $q;
        }

        return $q->where('name', 'like', '%'.$name.'%');
    }


    public function scopeFilterByParcode($q, $parcode = null)
    {
        if (! $parcode) {
            return $q;
        }

        return $q->where('parcode', 'like', '%'.$name.'%');
    }

}
