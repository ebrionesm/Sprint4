<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeckHasCard extends Model
{
    use HasFactory;
    protected $table = 'deck_has_card';
    protected $fillable = [
        'id_deck',
        'id_card',
        'card_quantity'
    ];

    public function deckHasCard()
    {
        //$deck = Deck::find($this->id_deck);
        return $this->belongsTo('\App\Models\DeckHasCard');
    }
}
