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

CREATE TABLE deck_has_card
(
	id_deck INT,
    id_card INT,
    PRIMARY KEY(id_deck, id_card),
    FOREIGN KEY(id_deck) REFERENCES Deck(id_deck),
    FOREIGN KEY(id_card) REFERENCES Card(id_card)
);

INSERT INTO deck VALUE(1, 'Gardevoir EX', 'standard', 60);