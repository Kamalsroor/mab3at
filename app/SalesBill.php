<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBill extends Model
{
    //
    protected $fillable = ['branch_id', 'user_id', 'customer_id', 'note', 'img', 'amount', 'date_at'];
    protected $primaryKey = 'id';
    protected $table = 'sales_bills';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function SalesBillDetails()
    {
        return $this->hasMany('App\SalesBillDetails', 'sales_bill_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
