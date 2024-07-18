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
                    $cardAddPosition = $request->input('currentCards');
                    if (isset($this->currentDeckCards[$cardAddPosition])) {
                        // Si la carta ya está en el mazo, incrementar la cantidad
                        if (isset($this->currentDeckCards[$cardAddPosition]['quantity'])) {
                            $cardQuery = Card::find($cardAddPosition);
                            $cardsArray = $cardQuery->toArray();
                            if ($cardQuery && $this->checkCardLimit($cardsArray)) 
                            {
                                $this->currentDeckCards[$cardAddPosition]['quantity']++;
                            }
                        }
                        
                    } else {
                        // Si la carta no está en el mazo, añadirla con cantidad inicial 1
                        $cardQuery = Card::find($cardAddPosition);
                        $cardsArray = $cardQuery->toArray();
                        if ($cardQuery && $this->checkCardLimit($cardsArray)) 
                        {
                            $this->currentDeckCards[$cardAddPosition] = [
                                'quantity' => 1,
                                'card' => $cardQuery,
                            ];
                        }
                    }

                    session(['currentDeckCards' => $this->currentDeckCards]);
                }
                
                return view('decks.currentDeckList', ['returnCards' => $this->currentDeckCards]);
                
            }
            else if($request->input('deleteCard'))
            {
                $cardRemovePosition = $request->input('deleteCard');
                if (isset($this->currentDeckCards[$cardRemovePosition])) 
                {
                    // Si la cantidad es mayor que 1, disminuir la cantidad
                    if ($this->currentDeckCards[$cardRemovePosition]['quantity'] > 1) {
                        $this->currentDeckCards[$cardRemovePosition]['quantity']--;
                    } else {
                        // Si la cantidad es 1, eliminar la carta del mazo
                        unset($this->currentDeckCards[$cardRemovePosition]);
                    }
                }

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
        echo 'hola5';
        foreach($this->currentDeckCards as $cardId => $cardData)
        {
            echo 'hola6';
            if($cardData['card']->id_card == $cardsArray['id_card'])
            {
                echo 'hola2';
                if($cardData['card']->card_rarity != 'radiant')
                {
                    echo 'hola3';
                    if($cardData['quantity'] >= 4)
                    {
                        return false;
                    }
                }
                else
                {
                    echo 'hola4';
                    if($cardData['quantity'] >= 1)
                    {
                        return false;
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
