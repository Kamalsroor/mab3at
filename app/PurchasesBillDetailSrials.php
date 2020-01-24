<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesBillDetailSrials extends Model
{
    //
    protected $fillable = ['purchases_bill_detail_id', 'user_id', 'srialnumper'];
    protected $primaryKey = 'id';
    protected $table = 'purchases_bills_detail_srials';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function PurchasesBillDetails()
    {
        return $this->belongsTo('App\PurchasesBillDetails', 'purchases_bill_detail_id');
    }

}
