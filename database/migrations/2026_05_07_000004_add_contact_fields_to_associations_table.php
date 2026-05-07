<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('associations', function (Blueprint $table) {
            $table->string('cap', 10)->nullable()->after('address');
            $table->string('city', 100)->nullable()->after('cap');
            $table->string('province', 10)->nullable()->after('city');
            $table->string('fiscal_code', 30)->nullable()->after('province');
            $table->string('vat_number', 30)->nullable()->after('fiscal_code');
            $table->string('phone', 30)->nullable()->after('vat_number');
            $table->string('fax', 30)->nullable()->after('phone');
            $table->string('email', 100)->nullable()->after('fax');
            $table->string('website', 200)->nullable()->after('email');
            $table->text('other')->nullable()->after('website');
        });
    }

    public function down()
    {
        Schema::table('associations', function (Blueprint $table) {
            $table->dropColumn(['cap', 'city', 'province', 'fiscal_code', 'vat_number', 'phone', 'fax', 'email', 'website', 'other']);
        });
    }
};