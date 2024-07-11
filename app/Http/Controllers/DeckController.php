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
        
        $type = $request->input('type');

        // Inicia la consulta usando Eloquent o Query Builder
        $query = Card::query();

        // Aplica el filtro por tipo de carta si se proporciona
        if ($type) {
            $query->where('card_type', $type);
        }

        // Ejecuta la consulta y obtén los resultados
        $cards = $query->get();

        // Devuelve la vista adecuada según si es AJAX o no
        if ($request->ajax()) 
        {
            
            return view('decks.partial', compact('cards'));
        } 
        else 
        {
            return view('decks.create', compact('cards'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeckRequest $request)
    {
        \Log::info('Entering store method');
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
