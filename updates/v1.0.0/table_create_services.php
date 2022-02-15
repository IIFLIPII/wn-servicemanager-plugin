<?php

namespace PhilippKuhn\ServiceManager\Updates;

use PhilippKuhn\ServiceManager\Models\Service;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateServicesTable extends Migration
{
    public function up ()
    {
        Schema::create(Service::TABLE_NAME, function (Blueprint $table) {
           $table->engine = 'InnoDB';
           $table->increments('id')->unsigned();
           $table->string('name', 80);
           $table->text('description');
           $table->float('price');
           $table->integer('time');
           $table->integer('category_id');
           $table->boolean('is_special')->default(false);
           $table->boolean('is_active')->default(false);
           $table->timestamp('published_at')->nullable();
           $table->softDeletes();
           $table->timestamps();
           $table->integer('sort_order')->default(0);
        });
    }

    public function down ()
    {
        Schema::dropIfExists(Service::TABLE_NAME);
    }
}
