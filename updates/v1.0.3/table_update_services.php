<?php

namespace PhilippKuhn\ServiceManager\Updates;

use PhilippKuhn\ServiceManager\Models\Service;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Updates\Migration;

class UpdateServicesTable2 extends Migration
{
    public function up()
    {
        Schema::table(Service::TABLE_NAME, function (Blueprint $table) {
            $table->boolean('is_highlight')->default(false);
        });
    }

    public function down()
    {
        Schema::table(Service::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn('is_highlight');
        });
    }
}
