<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TroubleshootTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'sub_subcategory_id',
        'title',
        'content',
        'video_url',
    ];
    public function category()
    {
        return $this->belongsTo(TroubleshootCategory::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(TroubleshootSubcategory::class);
    }

    public function subSubcategory()
    {
        return $this->belongsTo(TroubleshootSubSubcategory::class);
    }
}
