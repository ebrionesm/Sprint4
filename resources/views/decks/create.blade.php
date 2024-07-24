
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
            @include('decks.deckForm')
        </form>
        @include('decks.currentDeckList')      
    </div>
        
    @include('decks.filterCardButtons')
        
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
                    setUpDeleteButtons();
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



