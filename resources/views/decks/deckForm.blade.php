@csrf
<div class="mb-4">
    <label for="deck_name" class="block text-sm font-bold text-gray-600">Deck Name</label>
    <input type="text" id="deck_name" name="deck_name" placeholder="Enter deck name" value="{{ isset($currentDeckName) ? $currentDeckName : 'New Deck' }}"
        class="w-full px-4 py-1 text-gray-700 bg-gray-200 rounded" required>
</div>
<div class="mb-6">
    <label for="deck_format" class="block text-gray-700 text-sm font-bold mb-2">Deck Format</label>
    <div class="relative">
        <select id="deck_format" name="deck_format"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <option value="standard" class="bg-blue-500" selected>Standard</option>
            <option value="expanded" class="bg-red-500">Expanded</option>
        </select>
    </div>
</div>
<div class="mb-4">
    <!--<p class="block text-gray-700 text-sm font-bold mb-2">Card amount</p>
    <p class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">0</p>-->
    <input type="hidden" id="card_amount" name="card_amount" value="0">
</div>
@if(isset($id_deck))
    <div class="mb-4">
        <!--<p class="block text-gray-700 text-sm font-bold mb-2">Card amount</p>
        <p class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">0</p>-->
        <input type="hidden" id="id_deck" name="id_deck" value={{$id_deck}}>
    </div>
@endif
<div class="flex items-center justify-between">
    <button type="submit"
            class="hover:bg-green-700 px-4 py-1 text-white tracking-wider bg-green-500 rounded">
        {{ isset($currentDeckName) ? 'Update' : 'Create' }} deck
    </button>
    <a href="{{route('decks.main')}}" class="hover:bg-red-700 px-4 py-1 text-white tracking-wider bg-red-500 rounded">
        Cancel
    </a>
</div>