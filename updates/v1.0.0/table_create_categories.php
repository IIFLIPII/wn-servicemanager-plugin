<?php

namespace PhilippKuhn\ServiceManager\Updates;

use PhilippKuhn\ServiceManager\Models\Category;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up ()
    {
        Schema::create(Category::TABLE_NAME, function (Blueprint $table) {
           $table->engine = 'InnoDB';
           $table->increments('id')->unsigned();
           $table->string('name', 40);
           $table->text('description');
           $table->boolean('is_active')->default(false);
           $table->timestamp('published_at')->nullable();
           $table->softDeletes();
           $table->timestamps();
           $table->integer('sort_order')->default(0);
        });
    }

    public function down ()
    {
        Schema::dropIfExists(Category::TABLE_NAME);
    }
}
