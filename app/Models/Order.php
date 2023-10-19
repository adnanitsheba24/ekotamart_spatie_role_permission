<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function division(){
    	return $this->belongsTo(ShipDivision::class,'division_id','id');
    }

    public function district(){
    	return $this->belongsTo(ShipDistrict::class,'district_id','id');
    }

    public function upazila(){
    	return $this->belongsTo(ShipUpazila::class,'upazila_id','id');
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }


    public function order_item(){
    	return $this->belongsTo(OrderItem::class,'id','order_id');
    }

}
