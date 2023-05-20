<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['size', 'qty', 'unit_price'];

    public function setSubTotal($qty, $unit_price) 
    {
        $this->attributes['sub_total'] = $qty * $unit_price;
    }

    public function getSubTotal() 
    {
        return $this->sub_total;
    }
}
