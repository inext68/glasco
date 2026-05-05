<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('association_group', function (Blueprint $table) {
            $table->foreignId('association_id')->constrained('associations')->cascadeOnDelete();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete();
            $table->primary(['association_id', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('association_group');
    }
};
