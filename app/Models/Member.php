<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'designation', 'fb_url', 'lk_url', 'ig_url', 'image', 'status'];
}
