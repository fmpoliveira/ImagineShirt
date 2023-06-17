<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Order extends Model
{
    const DEFAULT_STATUS = "pending";

    use HasFactory;
    // TODO - perceber melhor o mass assignment
    protected $fillable = ['status', 'customer_id', 'date', 'total_price', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url'];

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

    public function orderItems(): HasMany
    {
        return $this->hasMany(Color::class, 'order_id', 'id');
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
