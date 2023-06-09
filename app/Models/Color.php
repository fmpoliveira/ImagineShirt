<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';
    protected $primaryKey = 'code';
    protected $fillable = ['code', 'name'];

    public function orderItems(): HasMany
    {
        return $this->hasMany(Color::class, 'color_code', 'code');
    }
}
