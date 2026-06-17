<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeIdAndServiceIdToCertificatesTable extends Migration
{
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('office_id')->after('id'); // or wherever appropriate
            $table->unsignedBigInteger('service_id')->after('office_id');

            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropForeign(['office_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['office_id', 'service_id']);
        });
    }
}
