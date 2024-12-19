<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('callmeaf-country.model'))->nullable()->constrained(getTableName(config('callmeaf-country.model')))->cascadeOnDelete();
            $table->foreignIdFor(config('callmeaf-province.model'),'parent_id')->nullable()->constrained(getTableName(config('callmeaf-province.model')))->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
