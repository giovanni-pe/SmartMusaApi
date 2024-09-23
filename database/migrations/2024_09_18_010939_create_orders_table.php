<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('customer_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('zip');
            $table->date('delivery_date');
            $table->enum('status', ['pending', 'completed','pagado','entregado','cancelado'])->default('pending');
            $table->timestamps(); 
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
