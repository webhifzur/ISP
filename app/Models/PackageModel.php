<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    use HasFactory;
    protected $fillable = ['package_title', 'package_speed', 'package_price', 'package_discription', 'status'];
}
