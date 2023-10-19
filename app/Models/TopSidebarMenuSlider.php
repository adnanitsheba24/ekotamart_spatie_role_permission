<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSidebarMenuSlider extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function top_sidebar()
    {
        return $this->belongsTo(TopSidebar::class, 'top_sidebar_id', 'name_en');
    }


}
