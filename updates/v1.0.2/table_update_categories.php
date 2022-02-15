<?php

namespace PhilippKuhn\ServiceManager\Updates;

use PhilippKuhn\ServiceManager\Models\Category;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Updates\Migration;

class UpdateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table(Category::TABLE_NAME, function (Blueprint $table) {
            $table->string('slug')->index();
        });
    }

    public function down()
    {
        Schema::table(Category::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
