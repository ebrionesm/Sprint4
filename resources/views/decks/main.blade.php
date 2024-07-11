@extends('layout.index')
@section('index')
<div class="p-5">
    <a href="/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Create deck
    </a>
    </div>
    <div class="flex flex-wrap -mx-4">
        @foreach ($decks as $deck)
        <button class="p-4 w-1/4 px-4 mb-4">
            <div class="max-w-xs rounded overflow-hidden shadow-lg bg-blue-500 text-white mb-4 p-4 h-64 w-48 relative">
                <p>{{ $deck->deck_name}}</p>
                <p>{{ $deck->card_amount}}/60</p>
            </div>
        </button>
        @endforeach
</div>