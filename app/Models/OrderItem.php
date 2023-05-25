<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['size', 'qty', 'unit_price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'order_id', 'id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'color_code', 'code');
    }

    public function tshirtImage(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'tshirt_image_id', 'id');
    }

    public function setSubTotal($qty, $unit_price)
    {
        $this->attributes['sub_total'] = $qty * $unit_price;
    }

    public function getSubTotal()
    {
        return $this->sub_total;
    }
}
