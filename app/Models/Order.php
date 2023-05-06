<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const DEFAULT_STATUS = "pending";

    use HasFactory;
    protected $fillable = ['status', 'notes', 'nif', 'address', 'payment_type', 'payment_ref', 'receipt_url'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::DEFAULT_STATUS,
    ];

}