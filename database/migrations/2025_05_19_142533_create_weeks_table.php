<?php

use App\Models\Course;
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
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('study_plan_file');
            $table->unsignedSmallInteger('order')->default(0);
            $table->unsignedTinyInteger('week_number');
            $table->foreignIdFor(Course::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->index(['order','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
