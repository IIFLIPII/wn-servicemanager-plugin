<?php

namespace PhilippKuhn\ServiceManager\Updates;

use PhilippKuhn\ServiceManager\Models\Service;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Updates\Migration;

class UpdateServicesTable extends Migration
{
    public function up()
    {
        Schema::table(Service::TABLE_NAME, function (Blueprint $table) {
            $table->integer('category_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table(Service::TABLE_NAME, function (Blueprint $table) {
            $table->integer('category_id')->nullable(false)->change();
        });
    }
}
