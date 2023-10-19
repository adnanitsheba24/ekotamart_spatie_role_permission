<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('book_type_id')->nullable();
            $table->integer('publication_id')->nullable();
            $table->integer('product_units_id')->nullable();
            $table->string('product_name_en');
            $table->string('product_name_bn');
            $table->string('product_slug_en');
            $table->string('product_slug_bn');
            $table->string('product_code')->nullable();
            $table->integer('product_qty');
            $table->string('product_tags_en')->nullable();
            $table->string('product_tags_bn')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_size_bn')->nullable();
            $table->string('product_color_en')->nullable();
            $table->string('product_color_bn')->nullable();
            $table->integer('selling_price');
            $table->integer('discount_price')->nullable();
            $table->date('expired_date')->nullable();
            $table->longText('short_descp_en');
            $table->longText('short_descp_bn');
            $table->longText('long_descp_en');
            $table->longText('long_descp_bn');
            $table->string('product_thambnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->string('sid_sps_section')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
