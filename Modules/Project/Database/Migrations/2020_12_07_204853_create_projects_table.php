<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_status_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('project_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('price', 25)->nullable();
            $table->integer('periode')->nullable();
            $table->integer('profit')->nullable();
            $table->integer('stock')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('status_id')->default(1)->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
