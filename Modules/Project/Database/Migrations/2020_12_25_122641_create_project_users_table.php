<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->char('is_paid')->default('0');
            // invoice
            $table->string('price', 50)->nullable();
            $table->string('payment_code')->nullable()->unique();
            // konfirmasi pembayaran
            $table->string('konfirmasi_bank')->nullable();
            $table->string('konfirmasi_norek')->nullable();
            $table->string('konfirmasi_nama')->nullable();
            $table->string('konfirmasi_jumlah')->nullable();
            $table->string('konfirmasi_image')->nullable();
            $table->dateTime('konfirmasi_date')->nullable();
            // verifikasi pembayaran
            $table->unsignedBigInteger('confirmed_id')->nullable();
            $table->dateTime('confirmed_date')->nullable();
            $table->char('is_confirmed')->default('0');
            $table->char('is_approved')->default('0');
            $table->timestamps();

            $table->foreign('confirmed_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_users');
    }
}
