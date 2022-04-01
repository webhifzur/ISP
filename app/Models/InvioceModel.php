<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvioceModel extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_no', 'package_title','package_speed', 'package_price', 'cust_id' , 'created_by'];

    public function customer()
    {
        return $this->hasOne(CustomerModel::class, 'id', 'cust_id');
    }
}
