<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            // User assigned task
            $table->unsignedBigInteger('assigned_to');

            

            // Team assigned by Team Lead
            $table->unsignedBigInteger('team_id')->nullable();

            // Admin / Team Lead creator
            $table->unsignedBigInteger('created_by');

            // Category
            $table->unsignedBigInteger('category_id')->nullable();

            // Status
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed'
            ])->default('pending');

            // Due Date
            $table->date('due_date')->nullable();

            $table->timestamps();

            /*
            |----------------------------------------------------------
            | FOREIGN KEYS
            |----------------------------------------------------------
            */

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};