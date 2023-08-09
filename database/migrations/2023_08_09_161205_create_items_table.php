<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 100)->required();
            $table->text('body');
            $table->date('now_at');
            $table->time('time_at');
            $table->decimal('value', 18,2);
            $table->unsignedBigInteger('item_types_id', false, false);
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('item_types_id')->references('id')->on('item_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
