<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TroubleshootSubSubcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
    ];
    public function subcategory()
    {
        return $this->belongsTo(TroubleshootSubcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(TroubleshootCategory::class);
    }
}
