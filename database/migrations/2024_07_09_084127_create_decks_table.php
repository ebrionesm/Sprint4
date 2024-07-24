<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deck', function (Blueprint $table) {
            $table->increments('id_deck'); // Auto-incremental primary key
            $table->string('deck_name', 30); // VARCHAR(30) NOT NULL
            $table->enum('deck_format', ['standard', 'expanded']); // ENUM for deck_format
            $table->integer('card_amount')->nullable(); // INT nullable
            $table->timestamps(); // created_at and updated_at

            $table->primary('id_deck');
        });

        DB::table('deck')->insert([
            ['deck_name' => 'Lost Zone Box', 'deck_format' => 'standard', 'card_amount' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['deck_name' => 'Gardevoir EX', 'deck_format' => 'standard', 'card_amount' => 55, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck');
    }
};
