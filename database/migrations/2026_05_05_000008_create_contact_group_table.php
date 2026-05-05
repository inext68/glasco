<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_group', function (Blueprint $table) {
            $table->foreignId('person_id')->constrained('persons')->cascadeOnDelete();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete();
            $table->boolean('is_member_of_group')->default(false);
            $table->primary(['person_id', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_group');
    }
};
