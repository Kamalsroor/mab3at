<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBillDetails extends Model
{
    //
    protected $fillable = ['sales_bill_id', 'user_id', 'product_id', 'amount'];
    protected $primaryKey = 'id';
    protected $table = 'sales_bills_details';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function SalesBill()
    {
        return $this->belongsTo('App\SalesBill', 'sales_bill_id');
    }

    public function SalesBillDetailSrials()
    {
        return $this->hasMany('App\SalesBillDetailSrials', 'sales_bill_detail_id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
