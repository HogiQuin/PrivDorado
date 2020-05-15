<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 10, 2);
            $table->string('uri_file', 100);
            $table->unsignedInteger('payment_status_id');
            $table->foreign('payment_status_id')
                ->references('id')
                ->on('payment_statuses');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('authorized_by')
                ->nullable();
            $table->foreign('authorized_by')
                ->references('id')
                ->on('users');
            $table->unsignedInteger('payment_type_id');
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types');
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
        Schema::dropIfExists('payments');
    }
}
