
<div id="card-container" >
    <div class="flex px-4 mt-4 " >
        <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="">Todas las cartas</button>
        <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="pokemon">Pokemon</button>
        <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="trainer">Trainer</button>
        <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-type="energy">Energy</button>
    </div>
    <div id="original-cards">
    @foreach ($cards as $card)
        <button class="p-4 w-1/7 px-4 mb-2">
            <div class="max-w-xs rounded overflow-hidden shadow-lg bg-blue-500 text-white p-4 h-64 w-48 relative">
                <p>{{ $card->card_name }}</p>
                <p>{{ $card->card_type }}</p>
                    
            </div>

            
        </button>
        
    @endforeach
    </div>
    
</div>