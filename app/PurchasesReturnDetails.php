<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesReturnDetails extends Model
{
    //
    protected $fillable = ['purchases_return_id', 'purchases_bills_detail_Srial_id', 'user_id', 'product_id', 'amount'];
    protected $primaryKey = 'id';
    protected $table = 'purchases_bills_details';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function PurchasPurchasesReturnesBill()
    {
        return $this->belongsTo('App\PurchasesBill', 'purchases_return_id');
    }

    public function PurchasesBillDetailSrials()
    {
        return $this->belongsTo('App\PurchasesBillDetailSrials', 'purchases_bills_detail_Srial_id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

}
