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
        //$deck = DB::table('card')->where('card_expansion', 'PAL')->first();
        //$formato = $deck->card_name;
        return view('decks.main', ['decks' => $decks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->input('data'))
        {
            $type = $request->input('data');
            $query = Card::query();

            // Aplica el filtro por tipo de carta si se proporciona
            if ($type) {
                $query->where('card_type', $type);
            }

            // Ejecuta la consulta y obtén los resultados
            $cards = $query->get();
        }
        else
        {
            $cards = Card::all();
        }

        $returnCards = $this->currentDeckCards;
        

        if($request->ajax())
        {
            //echo "bbbb";
            if($request->input('currentCards'))
            {
                if(!$this->checkDeckLimit())
                {
                    if (isset($this->currentDeckCards[$request->input('currentCards')])) {
                        // Si la carta ya está en el mazo, incrementar la cantidad
                        if (isset($this->currentDeckCards[$request->input('currentCards')]['quantity'])) {
                            $this->currentDeckCards[$request->input('currentCards')]['quantity']++;
                        }
                        
                    } else {
                        // Si la carta no está en el mazo, añadirla con cantidad inicial 1
                        $cardQuery = Card::find($request->input('currentCards'));
                        $cardsArray = $cardQuery->toArray();
                        if ($cardQuery && $this->checkCardLimit($cardsArray)) 
                        {
                            $this->currentDeckCards[$request->input('currentCards')] = [
                                'quantity' => 1,
                                'card' => $cardQuery,
                            ];
                        }
                    }
                    /*$currentCard = $request->input('currentCards');
                    $cardQuery = Card::query();

                    // Aplica el filtro por tipo de carta si se proporciona
                    if ($currentCard) {
                        $cardQuery->where('id_card', $currentCard);
                    }

                    // Obtén los resultados de la consulta y conviértelos a array
                    $cardsArray = $cardQuery->get()->toArray();

                    // Añadir los resultados al array de cartas del mazo actual
                    if($this->checkCardLimit($cardsArray))
                    {
                        $this->currentDeckCards = array_merge($this->currentDeckCards, $cardsArray);
                    }*/
                    

                    // Guardar las cartas del mazo actual en la sesión
                    session(['currentDeckCards' => $this->currentDeckCards]);
                }
                
                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
                
            }
            else if($request->input('deleteCard'))
            {
                $cardPosition = -1;
                foreach($this->currentDeckCards as $cardId => $cardData)
                {
                    if($cardData['id_card'] == $request->input('deleteCard'))
                    {
                        $cardPosition = $cardId;
                    }
                }

                if ($cardPosition != -1) {
                    array_splice($this->currentDeckCards, $cardPosition, 1);
                }

                $this->currentDeckCards = array_values($this->currentDeckCards);

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

    public function checkCardLimit(array $cardsArray) : bool
    {
        $cardCount = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            if (isset($cardId['card']))
            {
                if($cardData['card']->id_card == $cardsArray[0]->id_card)
                {
                    
                    if($cardData['card']->card_rarity != 'radiant')
                    {
                        if($cardId['quantity'] >= 4)
                        {
                            return false;
                        }
                    }
                    else
                    {
                        if($cardId['quantity'] >= 1)
                        {
                            return false;
                        }
                    }
                    
                }
            }
            
            
        }

        return true;
    }

    public function checkDeckLimit()
    {
        $totalCards = 0;
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            if (isset($cardId['quantity'])) {
                $totalCards += $cardId['quantity'];
            }
        }
        return $totalCards > 60;
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
        $deck->deck_name = $request->deck_name;
        $deck->deck_format = $request->deck_format;
        $deck->card_amount = count($this->currentDeckCards);
        $deck->save();

        
        foreach($this->currentDeckCards as $currentCard)
        {
            $deckHasCard = new DeckHasCard;
            $deckHasCard->id_deck = $deck->id_deck;
            $deckHasCard->id_card = $currentCard['id_card'];
            $deckHasCard->card_quantity = 0;
            $deckHasCard->save();
        }

        session()->forget('currentDeckCards');

        $decks = DB::table('deck')->get();
        return view('decks.main', ['decks' => $decks]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck)
    {
        //
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
    public function destroy(Deck $deck)
    {
        //
    }
}
