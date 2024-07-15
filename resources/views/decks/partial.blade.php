
<div id="card-container" >
    <div class="flex flex-col px-4 mt-4 " >
        <div class="py-2">
            <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="">All cards</button>
        </div>
        <div class="py-2">
            <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="pokemon">Pokemon</button>
            <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="trainer">Trainer</button>
            <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-type="energy">Energy</button>
        </div>
    </div>
    <div id="original-cards" class="flex flex-wrap">
    @foreach ($cards as $card)
        <div class="p-4 w-1/7 px-4 mb-2" >
            <div class="max-w-xs rounded overflow-hidden shadow-lg bg-blue-500 text-white p-4 h-64 w-48 relative">
                <p>{{ $card->card_name }}</p>
                <p>{{ $card->card_type }}</p>
                <p>0</p>
                <button class="add-btn inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" card-id="{{$card->id_card}}">+</button>
                <button class="delete-btn inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" card-id="{{$card->id_card}}">-</button>
            </div>

            
        </div>
        
    @endforeach
    </div>
    
</div>