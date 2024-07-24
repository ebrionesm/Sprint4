<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Card;
use App\Models\DeckHasCard;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeckRequest;
use App\Http\Requests\UpdateDeckRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class DeckController extends Controller
{
    private array $currentDeckCards = [];
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Recuperar las cartas del mazo actual de la sesión
        $this->currentDeckCards = session('currentDeckCards', []);
    }
    public function index() : View
    {
        $decks = DB::table('deck')->get();
        session()->forget('currentDeckCards');
        $this->currentDeckCards = session('currentDeckCards', []);

        return view('decks.main', ['decks' => $decks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cards = $this->showCardFilter($request);

        $returnCards = $this->currentDeckCards;

        if($request->ajax())
        {
            if($request->input('currentCards'))
            {
                if(!$this->checkDeckLimit())
                {
                    $cardAddPosition = $request->input('currentCards');
                    $cardQuery = Card::find($cardAddPosition);
                    $cardsArray = $cardQuery->toArray();
                    $cardPosition = $this->checkCardInList($cardAddPosition, $cardsArray);
                    if(isset($this->currentDeckCards[$cardPosition]))
                    {
                        $this->addExistingCardToList($cardPosition, $cardQuery, $cardsArray);
                    }
                    else
                    {
                        $this->addNewCardToList($cardAddPosition, $cardQuery, $cardsArray);
                    }

                    session(['currentDeckCards' => $this->currentDeckCards]);
                }
                
                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
                
            }
            else if($request->input('deleteCard'))
            {
                $cardRemovePosition = $request->input('deleteCard');
                $cardQuery = Card::find($cardRemovePosition);
                $cardsArray = $cardQuery->toArray();
                $cardPosition = $this->checkCardInList($cardRemovePosition, $cardsArray);
                if(isset($this->currentDeckCards[$cardPosition]))
                    $this->removeCardFromList($cardPosition);

                session(['currentDeckCards' => $this->currentDeckCards]);

                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
            }
            else
            {
                return view('decks.partial', compact('cards'));
            }
            
        }
        else
        {
            return view('decks.create', compact('cards','returnCards'));
        }
    }

    public function showCardFilter(Request $request)
    {
        if($request->input('data'))
        {
            $type = $request->input('data');
            $query = Card::query();

            if ($type) {
                $query->where('card_type', $type);
            }
            
            $cards = $query->get();
        }
        else
        {
            $cards = Card::all();
        }

        return $cards;
    }

    public function addExistingCardToList(int $cardAddPosition, Card $cardQuery, array $cardsArray)
    {
        if (isset($this->currentDeckCards[$cardAddPosition]['quantity'])) {
            if ($cardQuery && $this->checkCardLimit($cardsArray)) 
            {
                $this->currentDeckCards[$cardAddPosition]['quantity']++;
            }
        }
    }

    public function addNewCardToList(int $cardAddPosition ,Card $cardQuery, array $cardsArray)
    {
        if ($cardQuery && $this->checkCardLimit($cardsArray)) 
        {
            array_push($this->currentDeckCards, 
            [
                'quantity' => 1,
                'card' => $cardQuery
            ]);
        }

    }

    public function removeCardFromList(int $cardRemovePosition)
    {
        if (isset($this->currentDeckCards[$cardRemovePosition])) 
        {
            
            if ($this->currentDeckCards[$cardRemovePosition]['quantity'] > 1) 
            {
                $this->currentDeckCards[$cardRemovePosition]['quantity']--;
            } 
            else 
            {
                
                unset($this->currentDeckCards[$cardRemovePosition]);
            }
        }
    }


    public function checkCardLimit(array $cardsArray) : bool
    {
        $cardCount = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            
            if($cardData['card']->id_card == $cardsArray['id_card'])
            {
                if($cardData['card']->card_type == 'energy')
                {
                    return true;
                }
                if($cardData['card']->card_rarity != 'radiant' )
                {
                    if($cardData['quantity'] >= 4)
                    {
                        return false;
                    }
                }
                else
                {
                    if($cardData['quantity'] >= 1)
                    {
                        return false;
                    }
                }
                
            }
            
            
        }

        return true;
    }

    public function checkCardInList(int $cardAddPosition, array $cardsArray)
    {
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            if($cardAddPosition == $cardData['card']->id_card)
            {
                return $cardId;
            }
        }

        return NULL;
    }

    public function checkDeckLimit()
    {
        $totalCards = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            if (isset($cardData['quantity'])) {
                $totalCards += $cardData['quantity'];
            }
        }

        return $totalCards >= 60;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deck_name' => 'required|string|max:255',
            'deck_format' => 'required|string',
            'card_amount' => 'nullable|int'
        ]);

        // Crear una nueva instancia del modelo Deck y guardar los datos
        $deck = new Deck;
        if($request->deck_name == "")
        {
            $deck->deck_name = "New deck";
        }
        else
        {
            $deck->deck_name = $request->deck_name;
        }
        
        $deck->deck_format = $request->deck_format;
        $cardQuantity = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            $cardQuantity += $cardData['quantity'];
        }
        $deck->card_amount = $cardQuantity;
        $deck->save();

        
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            $deckHasCard = new DeckHasCard;
            $deckHasCard->id_deck = $deck->id_deck;
            $deckHasCard->id_card = $cardData['card']->id_card;
            $deckHasCard->card_quantity = $cardData['quantity'];
            $deckHasCard->save();
        }

        session()->forget('currentDeckCards');

        $decks = DB::table('deck')->get();
        return redirect()->route('decks.main')->with('decks', $decks);
    }

    public function updateDeck(Request $request)
    {
        $request->validate([
            'deck_name' => 'required|string|max:255',
            'deck_format' => 'required|string',
            'card_amount' => 'nullable|int'
        ]);

        $cardQuantity = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            $cardQuantity += $cardData['quantity'];
        }

        Deck::where('id_deck', $request->id_deck)->update([
            'deck_name' => $request->deck_name,
            'deck_format' => $request->deck_format,
            'card_amount' => $cardQuantity
        ]);

        DeckHasCard::where('id_deck', $request->id_deck)->delete();
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            $deckHasCard = new DeckHasCard;
            $deckHasCard->id_deck = $request->id_deck;
            $deckHasCard->id_card = $cardData['card']->id_card;
            $deckHasCard->card_quantity = $cardData['quantity'];
            $deckHasCard->save();
        }
        $decks = DB::table('deck')->get();
        return redirect()->route('decks.main')->with('decks', $decks);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        //
    }

    public function loadDeck(int $id_deck)
    {
        $deckHasCardQuery = DeckHasCard::query();
        $deckHasCardQuery->where('id_deck', $id_deck)->orderBy('id_card', 'asc');

        $cardsInDeck = $deckHasCardQuery->get();
        $cardsArray = $cardsInDeck->toArray();
        foreach($cardsArray as $cardArray)
        {
            $card = Card::find($cardArray['id_card']);
            array_push($this->currentDeckCards, ['card' => $card, 'quantity' => $cardArray['card_quantity']]);
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id_deck)
    {
        $currentDeck = Deck::find($id_deck);
        $currentDeckName = $currentDeck->deck_name;
        $cards = $this->showCardFilter($request);
        if(count($this->currentDeckCards) == 0)
        {
            $this->loadDeck($id_deck);
        }
        
        session(['currentDeckCards' => $this->currentDeckCards]);
            

        $returnCards = $this->currentDeckCards;

        if($request->ajax())
        {
            if($request->input('currentCards'))
            {
                if(!$this->checkDeckLimit())
                {
                    $cardAddPosition = $request->input('currentCards');
                    $cardQuery = Card::find($cardAddPosition);
                    $cardsArray = $cardQuery->toArray();
                    $cardPosition = $this->checkCardInList($cardAddPosition, $cardsArray);
                    if(isset($this->currentDeckCards[$cardPosition]))
                    {
                        $this->addExistingCardToList($cardPosition, $cardQuery, $cardsArray);
                    }
                    else
                    {
                        $this->addNewCardToList($cardAddPosition, $cardQuery, $cardsArray);
                    }

                    session(['currentDeckCards' => $this->currentDeckCards]);
                }
                
                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
                
            }
            else if($request->input('deleteCard'))
            {
                $cardRemovePosition = $request->input('deleteCard');
                $cardQuery = Card::find($cardRemovePosition);
                $cardsArray = $cardQuery->toArray();
                $cardPosition = $this->checkCardInList($cardRemovePosition, $cardsArray);
                if(isset($this->currentDeckCards[$cardPosition]))
                    $this->removeCardFromList($cardPosition);

                session(['currentDeckCards' => $this->currentDeckCards]);

                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
            }
            else
            {
                return view('decks.partial', compact('cards'));
            }
            
        }

        return view('decks.update', compact('cards','returnCards', 'currentDeckName', 'id_deck'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeckRequest $request, Deck $deck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Deck $deck)
    {
        DeckHasCard::where('id_deck', $deck->id_deck)->delete();
        Deck::destroy($deck->id_deck);

        $decks = DB::table('deck')->get();


        return redirect()->route('decks.main')->with('decks', $decks);
    }
}
