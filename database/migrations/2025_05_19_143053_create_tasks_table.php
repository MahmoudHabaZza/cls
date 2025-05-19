<?php

use App\Models\CourseSession;
use App\Models\Session;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedSmallInteger('order')->default(0);
            $table->text('description');
            $table->foreignIdFor(CourseSession::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->index(['order','course_session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
