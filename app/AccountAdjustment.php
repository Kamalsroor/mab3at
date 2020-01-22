<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountAdjustment extends Model
{
    //
    protected $fillable = ['user_id', 'customer_id', 'note', 'img', 'amount', 'date_at'];
    protected $primaryKey = 'id';
    protected $table = 'account_adjustments';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
