<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['name', 'address', 'phone', 'telephone', 'user_id', 'email', 'type'];
    protected $primaryKey = 'id';
    protected $table = 'customers';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function DebentureCashings()
    {
        return $this->hasMany('App\DebentureCashing', 'customer_id');
    }

    public function DebentureDeposits()
    {
        return $this->hasMany('App\DebenturesDeposit', 'customer_id');
    }

    public function SalesBill()
    {
        return $this->hasMany('App\SalesBill', 'customer_id');
    }
    public function AccountAdjustment()
    {
        return $this->hasMany('App\AccountAdjustment', 'customer_id');
    }

    
    public function PurchasesBill()
    {
        return $this->hasMany('App\PurchasesBill', 'customer_id');
    }
}
