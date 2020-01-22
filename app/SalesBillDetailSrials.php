<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBillDetailSrials extends Model
{
    //
    protected $fillable = ['sales_bill_detail_id', 'user_id', 'srialnumper'];
    protected $primaryKey = 'id';
    protected $table = 'sales_bills_detail_Srials';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function SalesBillDetails()
    {
        return $this->belongsTo('App\SalesBillDetails', 'sales_bill_detail_id');
    }

}
