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
        Schema::create('card', function (Blueprint $table) {
            $table->increments('id_card'); // Auto-incremental primary key
            $table->string('card_name', 40); // VARCHAR(40) NOT NULL
            $table->enum('card_type', ['pokemon', 'trainer', 'energy']); // ENUM for card_type
            $table->string('card_expansion', 10); // VARCHAR(10) NOT NULL
            $table->enum('card_rarity', [
                'common', 'uncommon', 'rare', 'holo', 'ultra', 'secret', 'shiny holo', 'ex holo', 'levelX holo',
                'prime', 'legend', 'ace', 'gx', 'v holo', 'vmax holo', 'incredible', 'v-star holo', 'radiant',
                'double', 'illustration', 'special illustration', 'promo'
            ]); // ENUM for card_rarity
            $table->string('card_image', 200); // VARCHAR(200) NOT NULL
            $table->timestamps(); // created_at and updated_at
        });

        DB::table('card')->insert([
            ['card_name' => 'Comfey', 'card_type' => 'pokemon', 'card_expansion' => 'LOR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/comfey.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Sableye', 'card_type' => 'pokemon', 'card_expansion' => 'LOR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/sableye.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Cramorant', 'card_type' => 'pokemon', 'card_expansion' => 'LOR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/cramorant.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Radiant Greninja', 'card_type' => 'pokemon', 'card_expansion' => 'ASR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/greninja.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Bloodmoon Ursaluna ex', 'card_type' => 'pokemon', 'card_expansion' => 'TWM', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/ursaluna.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Iron Hands ex', 'card_type' => 'pokemon', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/iron_hands.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Iron Thorns ex', 'card_type' => 'pokemon', 'card_expansion' => 'TWM', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/iron_thorns.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Iron Bundle', 'card_type' => 'pokemon', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/iron_bundle.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('card')->insert([
            ['card_name' => 'Colress\'s Experiment', 'card_type' => 'trainer', 'card_expansion' => 'LOR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/colress_experiment.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Roxanne', 'card_type' => 'trainer', 'card_expansion' => 'ASR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/roxanne.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Boss\'s Orders', 'card_type' => 'trainer', 'card_expansion' => 'PAL', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/boss_orders.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Mirage Gate', 'card_type' => 'trainer', 'card_expansion' => 'LOR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/mirage_gate.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Nest Ball', 'card_type' => 'trainer', 'card_expansion' => 'PAF', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/nest_ball.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Switch Cart', 'card_type' => 'trainer', 'card_expansion' => 'ASR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/switch_cart.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Switch', 'card_type' => 'trainer', 'card_expansion' => 'SVI', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/switch.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Super Rod', 'card_type' => 'trainer', 'card_expansion' => 'PAL', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/super_rod.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Buddy-Buddy Poffin', 'card_type' => 'trainer', 'card_expansion' => 'TEF', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/buddy_buddy_poffin.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Lost Vacuum', 'card_type' => 'trainer', 'card_expansion' => 'CRZ', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/lost_vacuum.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Prime Catcher', 'card_type' => 'trainer', 'card_expansion' => 'TEF', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/prime_catcher.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Pokégear 3.0', 'card_type' => 'trainer', 'card_expansion' => 'SVI', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/pokegear.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Pal Pad', 'card_type' => 'trainer', 'card_expansion' => 'SVI', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/pal_pad.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Hisuian Heavy Ball', 'card_type' => 'trainer', 'card_expansion' => 'ASR', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/hisuian_heavy_ball.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Rescue Board', 'card_type' => 'trainer', 'card_expansion' => 'TEF', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/rescue_board.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'PokéStop', 'card_type' => 'trainer', 'card_expansion' => 'PGO', 'card_rarity' => 'rare', 'card_image' => 'https://example.com/pokestop.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('card')->insert([
            ['card_name' => 'Water Energy', 'card_type' => 'energy', 'card_expansion' => '', 'card_rarity' => 'common', 'card_image' => 'https://example.com/water_energy.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Lightning Energy', 'card_type' => 'energy', 'card_expansion' => '', 'card_rarity' => 'common', 'card_image' => 'https://example.com/lightning_energy.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['card_name' => 'Psychic Energy', 'card_type' => 'energy', 'card_expansion' => '', 'card_rarity' => 'common', 'card_image' => 'https://example.com/psychic_energy.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('card')->insert([
            // Pokémon
            ['card_name' => 'Ralts', 'card_type' => 'pokemon', 'card_expansion' => 'ASR', 'card_rarity' => 'common', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Kirlia', 'card_type' => 'pokemon', 'card_expansion' => 'SIT', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Gardevoir ex', 'card_type' => 'pokemon', 'card_expansion' => 'PAF', 'card_rarity' => 'ultra', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Munkidori', 'card_type' => 'pokemon', 'card_expansion' => 'TWM', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Drifloon', 'card_type' => 'pokemon', 'card_expansion' => 'SVI', 'card_rarity' => 'common', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Scream Tail', 'card_type' => 'pokemon', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Flutter Mane', 'card_type' => 'pokemon', 'card_expansion' => 'TEF', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Cresselia', 'card_type' => 'pokemon', 'card_expansion' => 'LOR', 'card_rarity' => 'holo', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Klefki', 'card_type' => 'pokemon', 'card_expansion' => 'SVI', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Manaphy', 'card_type' => 'pokemon', 'card_expansion' => 'BRS', 'card_rarity' => 'common', 'card_image' => 'placeholder.jpg'],

            // Trainers
            ['card_name' => 'Arven', 'card_type' => 'trainer', 'card_expansion' => 'OBF', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Iono', 'card_type' => 'trainer', 'card_expansion' => 'PAF', 'card_rarity' => 'ultra', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Professor Turo\'s Scenario', 'card_type' => 'trainer', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Ultra Ball', 'card_type' => 'trainer', 'card_expansion' => 'PAF', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Earthen Vessel', 'card_type' => 'trainer', 'card_expansion' => 'PAR', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Counter Catcher', 'card_type' => 'trainer', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Hyper Aroma', 'card_type' => 'trainer', 'card_expansion' => 'TWM', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Enhanced Hammer', 'card_type' => 'trainer', 'card_expansion' => 'TWM', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Bravery Charm', 'card_type' => 'trainer', 'card_expansion' => 'PAL', 'card_rarity' => 'uncommon', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Technical Machine: Evolution', 'card_type' => 'trainer', 'card_expansion' => 'PAR', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Artazon', 'card_type' => 'trainer', 'card_expansion' => 'PAF', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],
            ['card_name' => 'Temple of Sinnoh', 'card_type' => 'trainer', 'card_expansion' => 'ASR', 'card_rarity' => 'rare', 'card_image' => 'placeholder.jpg'],

            // Energy
            ['card_name' => 'Darkness Energy', 'card_type' => 'energy', 'card_expansion' => 'Base', 'card_rarity' => 'common', 'card_image' => 'placeholder.jpg'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
};
