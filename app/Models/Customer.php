<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends User
{
    use HasFactory, SoftDeletes;
    // Disables auto increment primary key
    public $incrementing = false;
    protected $fillable = ['nif', 'address', 'default_payment_type', 'default_payment_ref'];

    public function tshirtImages(): HasMany
    {
        return $this->hasMany(TshirtImage::class, 'customer_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    // public function user(): HasOne
    // {
    //     return $this->hasOne(User::class);
    // }

   
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
