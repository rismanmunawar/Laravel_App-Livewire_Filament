<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class TroubleshootSubcategory extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(TroubleshootCategory::class);
    }

    public function subSubcategories()
    {
        return $this->hasMany(TroubleshootSubSubcategory::class);
    }
}
