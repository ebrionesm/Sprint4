<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Card;
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
        
        /*if ($request->ajax())
        {
            if($request->input('data') == 'add')
            {
                
            }
            else if($request->input('data') == 'delete')
            {

            }
        }*/
        $type = $request->input('data');
        $query = Card::query();

        // Aplica el filtro por tipo de carta si se proporciona
        if ($type) {
            $query->where('card_type', $type);
        }

        // Ejecuta la consulta y obtén los resultados
        $cards = $query->get();

        $returnCards = $this->currentDeckCards;

        if($request->ajax())
        {
            echo "bbbb";
            if($request->input('currentCards'))
            {
                echo "AAA";
                $card = $request->input('currentCards');
                $queryCard = Card::query();
                $queryCard->where('id_card', $card);

                $card = $queryCard->get();
                if(count($this->currentDeckCards) > 0)
                {
                    foreach($this->currentDeckCards as $currentCard)
                    {
                        if($currentCard->card->id_card == $card->id_card)
                        {
                            $currentCard->quantity++;
                        }
                        else
                        {
                            array_push($this->currentDeckCards, $card);
                            $returnCards = $this->currentDeckCards;
                        }
                    
                    }
                    echo "hola";
                }
                else
                {
                    array_push($this->currentDeckCards, $card);
                    $returnCards = $this->currentDeckCards;
                }
                return view('decks.currentDeckList', compact('returnCards'));
                
            }
            return view('decks.partial', compact('cards', 'returnCards'));
        }
        else
        {
            return view('decks.create', compact('cards','returnCards'));
        }
        
        
        

        // Devuelve la vista adecuada según si es AJAX o no
        /*if ($request->ajax()) 
        {
            
        } 
        else 
        {
            
        }*/
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
        $deck->card_amount = $request->card_amount;
        $deck->save();

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
