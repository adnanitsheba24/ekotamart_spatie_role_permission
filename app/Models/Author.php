<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function book_type()
    {
        return $this->belongsTo(Book_type::class, 'book_type_id', 'id');
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id', 'id');
    }
    
}
