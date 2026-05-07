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
            $table->string('meeting_address')->nullable()->after('meeting_place');
            $table->string('meeting_cap', 10)->nullable()->after('meeting_address');
            $table->string('meeting_city')->nullable()->after('meeting_cap');
            $table->string('meeting_province', 5)->nullable()->after('meeting_city');
            $table->string('meeting_day')->nullable()->after('meeting_province');
            $table->time('meeting_time')->nullable()->after('meeting_day');
            $table->foreignId('responsible_id')->nullable()->constrained('persons')->nullOnDelete()->after('meeting_time');
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['responsible_id']);
            $table->dropColumn([
                'meeting_place',
                'meeting_address',
                'meeting_cap',
                'meeting_city',
                'meeting_province',
                'meeting_day',
                'meeting_time',
                'responsible_id'
            ]);
        });
    }
};