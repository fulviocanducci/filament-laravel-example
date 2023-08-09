<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100)->required();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_types');
    }
};
