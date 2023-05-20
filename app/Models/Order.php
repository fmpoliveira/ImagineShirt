<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    const DEFAULT_STATUS = "pending";

    use HasFactory;
    // TODO - perceber melhor o mass assignment
    protected $fillable = ['customer_id', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::DEFAULT_STATUS,
        // 'date' =>self::now()->timestamp;
    ];

    public function tshirtImages(): BelongsToMany
    {
        return $this->belongsToMany(TshirtImage::class, 'order_items');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'order_items');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // todo
    // public function setTotalPrice($qty, $unit_price) 
    // {
    //     $this->attributes['sub_total'] = $qty * $unit_price;
    // }

    public function getTotalPrice() 
    {
        return $this->total_price;
    }

}