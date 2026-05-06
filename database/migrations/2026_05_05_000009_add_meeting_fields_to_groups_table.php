<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('meeting_place')->nullable()->after('description');
            $table->string('meeting_day')->nullable()->after('meeting_place');
            $table->time('meeting_time')->nullable()->after('meeting_day');
            $table->foreignId('responsible_id')->nullable()->constrained('persons')->nullOnDelete()->after('meeting_time');
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['responsible_id']);
            $table->dropColumn(['meeting_place', 'meeting_day', 'meeting_time', 'responsible_id']);
        });
    }
};