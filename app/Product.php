<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name', 'group_id', 'category_id', 'min_price', 'max_price', 'image', 'parcode', 'img', 'status'];
    protected $primaryKey = 'id';
    protected $table = 'products';

    public function Category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function Group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function getNameWithParcodeAttribute()
    {
        return $this->name . ' (' . $this->parcode . ')';
    }

    public function PurchasesBillDetails()
    {
        return $this->hasMany('App\PurchasesBillDetails', 'product_id');
    }

    public function SalesBillDetails()
    {
        return $this->hasMany('App\SalesBillDetails', 'product_id');
    }
}
