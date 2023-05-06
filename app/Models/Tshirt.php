<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;
    protected $table = 'tshirt_images';
    protected $fillable = ['customer_id', 'category_id', 'name', 'description', 'image_url', 'extra_info', 'created_at', 'updated_at' . 'deleted_at'];
}
