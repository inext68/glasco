<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->string('street')->nullable()->after('notes');
            $table->string('postal_code', 10)->nullable()->after('street');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('province', 2)->nullable()->after('city');
            $table->string('document_number')->nullable()->after('province');
            $table->string('document_type')->nullable()->after('document_number');
        });
    }

    public function down()
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropColumn(['street', 'postal_code', 'city', 'province', 'document_number', 'document_type']);
        });
    }
};
