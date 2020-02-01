<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesReturn extends Model
{
    //
    protected $fillable = ['branch_id', 'user_id', 'customer_id', 'note', 'img', 'amount', 'date_at'];
    protected $primaryKey = 'id';
    protected $table = 'purchases_returns';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function PurchasesReturnsDetails()
    {
        return $this->hasMany('App\PurchasesReturnDetails', 'purchases_return_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
