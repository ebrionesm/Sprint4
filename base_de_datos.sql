
CREATE TABLE Deck
(
	id_deck INT PRIMARY KEY AUTO_INCREMENT,
    deck_name VARCHAR(30) NOT NULL,
	deck_format ENUM ('standard', 'expanded') NOT NULL,
	card_amount INT
);

CREATE TABLE Card
(
	id_card INT PRIMARY KEY AUTO_INCREMENT,
	card_name VARCHAR(40) NOT NULL,
	card_type ENUM('pokemon', 'trainer', 'energy') NOT NULL,
    card_expansion VARCHAR(10) NOT NULL,
    card_rarity ENUM('common', 'uncommon', 'rare', 'holo', 'ultra', 'secret', 'shiny holo', 'ex holo', 'levelX holo', 'prime', 'legend',
		'ace', 'gx', 'v holo', 'vmax holo', 'incredible', 'v-star holo', 'radiant', 'double', 'illustration', 'special illustration', 'promo') NOT NULL,
	card_image VARCHAR(200) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS deck_has_card;
CREATE TABLE deck_has_card
(
	id_deck INT,
    id_card INT,
    card_quantity INT NOT NULL,
    PRIMARY KEY(id_deck, id_card),
    FOREIGN KEY(id_deck) REFERENCES Deck(id_deck),
    FOREIGN KEY(id_card) REFERENCES Card(id_card)
);

INSERT INTO Deck(deck_name, deck_format, card_amount) VALUES('Lost Zone Box', 'standard', 60);
-- Pokémon
INSERT INTO Card (card_name, card_type, card_expansion, card_rarity, card_image)
VALUES ('Comfey', 'pokemon', 'LOR', 'rare holo', 'https://example.com/comfey.jpg'),
       ('Sableye', 'pokemon', 'LOR', 'rare', 'https://example.com/sableye.jpg'),
       ('Cramorant', 'pokemon', 'LOR', 'rare', 'https://example.com/cramorant.jpg'),
       ('Radiant Greninja', 'pokemon', 'ASR', 'rare holo', 'https://example.com/greninja.jpg'),
       ('Bloodmoon Ursaluna ex', 'pokemon', 'TWM', 'rare holo', 'https://example.com/ursaluna.jpg'),
       ('Iron Hands ex', 'pokemon', 'PAR', 'rare holo', 'https://example.com/iron_hands.jpg'),
       ('Iron Thorns ex', 'pokemon', 'TWM', 'rare holo', 'https://example.com/iron_thorns.jpg'),
       ('Iron Bundle', 'pokemon', 'PAR', 'rare', 'https://example.com/iron_bundle.jpg');

-- Trainer
INSERT INTO Card (card_name, card_type, card_expansion, card_rarity, card_image)
VALUES ('Colress\'s Experiment', 'trainer', 'LOR', 'rare holo', 'https://example.com/colress_experiment.jpg'),
       ('Roxanne', 'trainer', 'ASR', 'rare', 'https://example.com/roxanne.jpg'),
       ('Boss\'s Orders', 'trainer', 'PAL', 'rare holo', 'https://example.com/boss_orders.jpg'),
       ('Mirage Gate', 'trainer', 'LOR', 'rare holo', 'https://example.com/mirage_gate.jpg'),
       ('Nest Ball', 'trainer', 'PAF', 'rare', 'https://example.com/nest_ball.jpg'),
       ('Switch Cart', 'trainer', 'ASR', 'rare holo', 'https://example.com/switch_cart.jpg'),
       ('Switch', 'trainer', 'SVI', 'rare holo', 'https://example.com/switch.jpg'),
       ('Super Rod', 'trainer', 'PAL', 'rare', 'https://example.com/super_rod.jpg'),
       ('Buddy-Buddy Poffin', 'trainer', 'TEF', 'rare holo', 'https://example.com/buddy_buddy_poffin.jpg'),
       ('Lost Vacuum', 'trainer', 'CRZ', 'rare', 'https://example.com/lost_vacuum.jpg'),
       ('Prime Catcher', 'trainer', 'TEF', 'rare holo', 'https://example.com/prime_catcher.jpg'),
       ('Pokégear 3.0', 'trainer', 'SVI', 'rare holo', 'https://example.com/pokegear.jpg'),
       ('Pal Pad', 'trainer', 'SVI', 'rare holo', 'https://example.com/pal_pad.jpg'),
       ('Hisuian Heavy Ball', 'trainer', 'ASR', 'rare', 'https://example.com/hisuian_heavy_ball.jpg'),
       ('Rescue Board', 'trainer', 'TEF', 'rare holo', 'https://example.com/rescue_board.jpg'),
       ('PokéStop', 'trainer', 'PGO', 'rare', 'https://example.com/pokestop.jpg');

-- Energy
INSERT INTO Card (card_name, card_type, card_expansion, card_rarity, card_image)
VALUES ('Water Energy', 'energy', '', 'common', 'https://example.com/water_energy.jpg'),
       ('Lightning Energy', 'energy', '', 'common', 'https://example.com/lightning_energy.jpg'),
       ('Psychic Energy', 'energy', '', 'common', 'https://example.com/psychic_energy.jpg');
       
INSERT INTO deck_has_card (id_deck, id_card, card_quantity) VALUES
(1, 1, 4), -- 4x Comfey LOR 79
(1, 2, 1), -- 1x Sableye LOR 70
(1, 3, 1), -- 1x Cramorant LOR 50
(1, 4, 1), -- 1x Radiant Greninja ASR 46
(1, 5, 1), -- 1x Bloodmoon Ursaluna ex TWM 141
(1, 6, 1), -- 1x Iron Hands ex PAR 70
(1, 7, 1), -- 1x Iron Thorns ex TWM 77
(1, 8, 1), -- 1x Iron Bundle PAR 56
(1, 9, 4), -- 4x Colress's Experiment LOR 155
(1, 10, 1), -- 1x Roxanne ASR 150
(1, 11, 1), -- 1x Boss's Orders PAL 172
(1, 12, 4), -- 4x Mirage Gate LOR 163
(1, 13, 4), -- 4x Nest Ball PAF 84
(1, 14, 4), -- 4x Switch Cart ASR 154
(1, 15, 4), -- 4x Switch SVI 194
(1, 16, 3), -- 3x Super Rod PAL 188
(1, 17, 3), -- 3x Buddy-Buddy Poffin TEF 144
(1, 18, 3), -- 3x Lost Vacuum CRZ 135
(1, 19, 1), -- 1x Prime Catcher TEF 157
(1, 20, 1), -- 1x Pokégear 3.0 SVI 186
(1, 21, 1), -- 1x Pal Pad SVI 182
(1, 22, 1), -- 1x Hisuian Heavy Ball ASR 146
(1, 23, 1), -- 1x Rescue Board TEF 159
(1, 24, 4), -- 4x PokéStop PGO 68
(1, 25, 3), -- 3x Water Energy 3
(1, 26, 3), -- 3x Lightning Energy 4
(1, 27, 2); -- 2x Psychic Energy 5

