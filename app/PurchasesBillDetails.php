<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesBillDetails extends Model
{
    //
    protected $fillable = ['purchases_bill_id', 'user_id', 'product_id', 'amount'];
    protected $primaryKey = 'id';
    protected $table = 'purchases_bills_details';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function PurchasesBill()
    {
        return $this->belongsTo('App\PurchasesBill', 'purchases_bill_id');
    }

    public function PurchasesBillDetailSrials()
    {
        return $this->hasMany('App\PurchasesBillDetailSrials', 'purchases_bill_detail_id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

}
