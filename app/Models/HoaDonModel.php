<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonModel extends Model
{
    public $timestamp = false;
    protected $fillable = [
       'customer_id', 'shipping_id', 'status', 'total', 'payment_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'order';
}
