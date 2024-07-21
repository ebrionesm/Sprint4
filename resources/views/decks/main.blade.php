@extends('layout.index')
@section('index')
<div class="p-5">
    <a href="/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Create deck
    </a>
    </div>
    <div class="flex flex-wrap ">
        @foreach ($decks as $deck)
        <a class="p-4 px-5 mb-4">
            <div class="max-w-xs rounded overflow-hidden shadow-lg bg-blue-500 text-white mb-4 p-4 h-64 w-48 relative">
                <p>{{ $deck->deck_name}}</p>
                <p>{{ $deck->card_amount}}/60</p>
                <form action="{{ route('decks.update', $deck->id_deck) }}" method="get" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                </form>
                <!--<a href="/update?id_deck={{$deck->id_deck}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded " id_deck="{{$deck->id_deck}}" >
                    Update
                </a>-->
                <!--<a class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="{{$deck->id_deck}}">Update</a>-->
                <form action="{{ route('decks.delete', $deck->id_deck) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </form>
            </div>
        </a>
        @endforeach
</div>