<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('person_system_role', function (Blueprint $table) {
            $table->foreignId('person_id')->constrained('persons')->cascadeOnDelete();
            $table->foreignId('system_role_id')->constrained('system_roles')->cascadeOnDelete();
            $table->primary(['person_id', 'system_role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('person_system_role');
    }
};
