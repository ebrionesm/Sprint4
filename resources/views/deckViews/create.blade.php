@extends('layout.index')
@section('index')
<div class="max-w-md mx-auto mt-8">
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
            <label for="card_amount" class="block text-gray-700 text-sm font-bold mb-2">Card amount</label>
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

