
@extends('layout.index')
<div class="flex justify-center">
    <div class="w-2/5 max-w-md mx-auto mt-4" id="formulario">
        <form action="{{route('decks.store')}}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="deck_name" class="block text-gray-700 text-sm font-bold mb-2">Deck Name</label>
                <input type="text" id="deck_name" name="deck_name" placeholder="Enter deck name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="deck_format" class="block text-gray-700 text-sm font-bold mb-2">Deck Format</label>
                <div class="relative">
                    <select id="deck_format" name="deck_format"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="standard">Standard</option>
                        <option value="expanded">Expanded</option>
                    </select>
                    
                </div>
            </div>
            <div class="mb-4">
                <p class="block text-gray-700 text-sm font-bold mb-2">Card amount</p>
                <p class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">0</p>
                <input type="hidden" id="card_amount" name="card_amount" value="0">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Deck
                </button>
            </div>
        </form>
        
        
    </div>
        
    <div class="flex flex-wrap w-3/5 max-h-screen overflow-y-auto">
        <div class="flex flex-col px-4 mt-4 " >
            <div class="py-2">
                <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="">All cards</button>
            </div>
            <div class="py-2">
                <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="pokemon">Pokemon</button>
                <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" data-type="trainer">Trainer</button>
                <button class="filter-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" data-type="energy">Energy</button>
            </div>
            @include('decks.currentDeckList')
            @include('decks.partial')
        </div>
         <!-- Incluye la vista parcial de cartas -->
    </div>
        
</div>
    
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        const filterButtons = document.querySelectorAll('.filter-btn');
        const addButton = document.querySelectorAll('.add-btn');
        const deleteButton = document.querySelectorAll('.delete-btn');

        setUpAddButtons();

        filterButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const type = this.getAttribute('data-type');
                //const cardId = this.getAttribute('card-id');
                filterCards(type);
            });
        });

        function filterCards(type) {
            axios.get(`/create?data=${type}`)
                .then(response => {
                    const cardContainer = document.getElementById('card-container');
                    cardContainer.innerHTML = response.data;
                    setUpAddButtons();
                })
                .catch(error => {
                    console.error('Error fetching cards:', error);
                });
        }

        /*function setUpFilterButtons() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const type = this.getAttribute('data-type');
                    filterCards(type);
                });
            });
        }*/
        
        addButton.forEach(btn => {
                btn.addEventListener('click', function () {
                    const cardId = this.getAttribute('card-id');
                    addCards(cardId);
                });
            });

        function addCards(cardId) {
            console.log('Adding card with ID:', cardId);
            axios.get(`/create?currentCards=${cardId}`)
                .then(response => {
                    const deckList = document.getElementById('deck-list');
                    deckList.innerHTML = response.data;
                    console.log('Deck list updated');
                    setUpAddButtons();
                })
                .catch(error => {
                    console.error('Error fetching cards:', error);
                });
        }

        function setUpAddButtons()
        {
            const addButton = document.querySelectorAll('.add-btn');
            addButton.forEach(btn => {
                btn.addEventListener('click', function () {
                    const cardId = this.getAttribute('card-id');
                    
                    addCards(cardId);
                });
    
                
            });
        }
    });
</script>



