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
        Schema::create('deck_has_card', function (Blueprint $table) {
            $table->unsignedInteger('id_deck'); // Referencia a la clave primaria de la tabla decks
            $table->unsignedInteger('id_card'); // Referencia a la clave primaria de la tabla cards
            $table->integer('card_quantity'); // Campo para la cantidad de cartas, no puede ser nulo
            $table->timestamps(); // created_at and updated_at
            
            // Definir la clave primaria compuesta
            $table->primary(['id_deck', 'id_card']);
            
            // Definir las llaves foráneas
            $table->foreign('id_deck')->references('id_deck')->on('deck');
            $table->foreign('id_card')->references('id_card')->on('card');
        });

        DB::table('deck_has_card')->insert([
            // Inserts para el deck "Lost Zone Box" (ID: 1)
            ['id_deck' => 1, 'id_card' => 1, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 2, 'card_quantity' => 2],
            ['id_deck' => 1, 'id_card' => 3, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 4, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 5, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 6, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 7, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 8, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 9, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 10, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 11, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 12, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 13, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 14, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 15, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 16, 'card_quantity' => 3],
            ['id_deck' => 1, 'id_card' => 17, 'card_quantity' => 3],
            ['id_deck' => 1, 'id_card' => 18, 'card_quantity' => 3],
            ['id_deck' => 1, 'id_card' => 19, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 20, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 21, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 22, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 23, 'card_quantity' => 1],
            ['id_deck' => 1, 'id_card' => 24, 'card_quantity' => 4],
            ['id_deck' => 1, 'id_card' => 25, 'card_quantity' => 3],
            ['id_deck' => 1, 'id_card' => 26, 'card_quantity' => 3],
            ['id_deck' => 1, 'id_card' => 27, 'card_quantity' => 2],

            // Inserts para el deck "Gardevoir EX" (ID: 2)
            ['id_deck' => 2, 'id_card' => 28, 'card_quantity' => 4],
            ['id_deck' => 2, 'id_card' => 29, 'card_quantity' => 4],
            ['id_deck' => 2, 'id_card' => 30, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 31, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 32, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 33, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 34, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 35, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 36, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 4, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 37, 'card_quantity' => 4],
            ['id_deck' => 2, 'id_card' => 38, 'card_quantity' => 4],
            ['id_deck' => 2, 'id_card' => 39, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 11, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 17, 'card_quantity' => 4],
            ['id_deck' => 2, 'id_card' => 16, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 13, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 40, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 41, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 22, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 43, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 44, 'card_quantity' => 2],
            ['id_deck' => 2, 'id_card' => 45, 'card_quantity' => 1],
            ['id_deck' => 2, 'id_card' => 46, 'card_quantity' => 1],

            ['id_deck' => 2, 'id_card' => 27, 'card_quantity' => 7],
            ['id_deck' => 2, 'id_card' => 49, 'card_quantity' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck_has_card');
    }
};
