<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'table_number', 'status', 'total_amount'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}