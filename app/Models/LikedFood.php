<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedFood extends Model
{
    use HasFactory;
    public $table = "liked_foods";
    public $timestamps = false;
    protected $fillable = ['user_id', 'food_id'];
}
