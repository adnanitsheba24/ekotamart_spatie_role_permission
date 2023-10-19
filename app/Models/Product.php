<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function subsubcategory(){
    	return $this->belongsTo(SubSubCategory::class,'subsubcategory_id','id');
    }

    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function multiImg(){
    	return $this->belongsTo(MultiImg::class,'id','product_id');
    }

    public function author(){
    	return $this->belongsTo(Author::class,'author_id', 'id');
    }

    public function book_type(){
    	return $this->belongsTo(Book_type::class,'book_type_id', 'id');
    }

    public function publication(){
    	return $this->belongsTo(Publication::class,'publication_id', 'id');
    }

    public function product_units(){
    	return $this->belongsTo(ProductUnit::class,'product_units_id', 'id');
    }

}
