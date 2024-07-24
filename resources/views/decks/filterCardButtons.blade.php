<div class="flex flex-wrap w-3/4 overflow-y-auto">
    <div class="flex-col px-4 " >
        <div class="pb-2">
            <button class="filter-btn bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2 ml-4" data-type="">All cards</button>
            <button class="filter-btn bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" data-type="pokemon">Pokemon</button>
            <button class="filter-btn bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" data-type="trainer">Trainer</button>
            <button class="filter-btn bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-type="energy">Energy</button>
        </div>
        
        @include('decks.partial')
    </div>
        <!-- Incluye la vista parcial de cartas -->
</div>
