<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_hash', 64)->unique();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('mediaable_id');
            $table->string('mediaable_type');
            $table->foreignId('uploaded_by_person_id')->nullable()->constrained('persons')->nullOnDelete();
            $table->timestamps();
            $table->index(['mediaable_id', 'mediaable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};