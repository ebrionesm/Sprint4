
@extends('layout.index')
@include('decks.navbar')
<div class="fixed top-0 left-64 w-full px-12 py-4 bg-yellow-400 shadow-lg mb-6">
        <h1 class="text-xl font-bold text-gray-900 mb-2">
            Deck Builder
        </h1>
    </div>
<div class="flex justify-center ml-64 mt-28 w-full">
    
    <div class=" ml-12 w-1/4" id="formulario">
        <form action="{{route('decks.store')}}" method="POST" class="bg-white shadow-xl rounded px-8 pt-6 pb-11 mb-8">
            @csrf
            <div class="mb-4">
                <label for="deck_name" class="block text-sm text-gray-600">Deck Name</label>
                <input type="text" id="deck_name" name="deck_name" placeholder="Enter deck name" value="New Deck"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded">
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
                <!--<p class="block text-gray-700 text-sm font-bold mb-2">Card amount</p>
                <p class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">0</p>-->
                <input type="hidden" id="card_amount" name="card_amount" value="0">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="hover:bg-blue-800 px-4 py-1 text-white tracking-wider bg-blue-600 rounded">
                    Create Deck
                </button>
                <a href="{{route('decks.main')}}" class="hover:bg-red-700 px-4 py-1 text-white tracking-wider bg-red-500 rounded">
                    Cancel
                </a>
            </div>
            <div class="flex items-center justify-between">
                
            </div>
        </form>
        @include('decks.currentDeckList')
        
    </div>
        
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
        
</div>
    
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        const filterButtons = document.querySelectorAll('.filter-btn');
        const addButton = document.querySelectorAll('.add-btn');
        const deleteButton = document.querySelectorAll('.delete-btn');


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
                    console.error('Error cargando carta:', error);
                });
        }
        
        setUpAddButtons();

        function setUpAddButtons() {
            const addButton = document.querySelectorAll('.add-btn');
            addButton.forEach(btn => {
                // Usa un atributo de datos para asegurar que solo se añade un event listener una vez
                if (!btn.hasAttribute('data-listener-added')) {
                    btn.addEventListener('click', function() {
                        const cardId = this.getAttribute('card-id');
                        addCards(cardId);
                    });
                    btn.setAttribute('data-listener-added', 'true');
                }
            });
        }

        function addCards(cardId) {
            console.log('Agregar carta con id:', cardId);
            axios.get(`/create?currentCards=${cardId}`)
                .then(response => {
                    const deckList = document.getElementById('deck-list');
                    deckList.innerHTML = response.data;
                    console.log('Carta añadida');
                    setUpAddButtons();
                    setUpDeleteButtons();
                })
                .catch(error => {
                    console.error('Error cargando carta:', error);
                });
        }

        setUpDeleteButtons();

        function setUpDeleteButtons() {
            const addButton = document.querySelectorAll('.delete-btn');
            addButton.forEach(btn => {
                // Usa un atributo de datos para asegurar que solo se añade un event listener una vez
                if (!btn.hasAttribute('data-listener-added')) {
                    btn.addEventListener('click', function() {
                        const cardId = this.getAttribute('card-id');
                        deleteCards(cardId);
                    });
                    btn.setAttribute('data-listener-added', 'true');
                }
            });
        }

        function deleteCards(cardId) {
            console.log('Borrar carta con id:', cardId);
            axios.get(`/create?deleteCard=${cardId}`)
                .then(response => {
                    const deckList = document.getElementById('deck-list');
                    deckList.innerHTML = response.data;
                    console.log('Carta borrada');
                    setUpDeleteButtons();
                    setUpAddButtons();
                })
                .catch(error => {
                    console.error('Error cargando carta:', error);
                });
        }
    });
</script>



