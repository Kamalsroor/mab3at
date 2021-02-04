<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpFilter extends Model
{
    protected $fillable = ['start_ip','end_ip','description'];
    protected $primaryKey = 'id';
    protected $table = 'ip_filters';
    use SoftDeletes;

}
