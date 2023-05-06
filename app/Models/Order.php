<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const DEFAULT_STATUS = "pending";

    use HasFactory;
    protected $fillable = ['date', 'total_price', 'nif'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => self::DEFAULT_STATUS,
    ];

}