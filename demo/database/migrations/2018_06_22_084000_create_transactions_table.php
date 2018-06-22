<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranactions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->decimal('amount', 8, 2);
            $table->enum('type', ['Credit', 'Debit']);
            $table->date('transaction_date');
            $table->integer('chart_id')->unsigned();
            $table->timestamps();
            $table->foreign('chart_id')
                ->references('id')->on('charts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
