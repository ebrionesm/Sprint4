@extends('layout.index')
@section('index')
@include('decks.navbar')
<div class="flex">
    
    <div class="py-8">
        <div class="px-4 py-4 bg-gray-900 shadow-lg rounded-lg mb-6">
            <h1 class="text-xl font-bold text-white mb-2">
                My Decks
            </h1>
        </div>
            <div class="flex flex-wrap">
                <!--<a href="/create" class="bg-blue-500 hover:bg-blue-700 max-w-xs rounded overflow-hidden shadow-lg text-white mb-4 p-4 h-64 w-48 relative">
                    +
                </a>-->
                <a href="/create" class="p-4 px-4 mb-4 ">
                    
                    <div class=" bg-gray-200 max-w-xs rounded overflow-hidden shadow-lg text-gray-900 mb-1 p-4 h-64 w-48 relative flex items-center justify-center">
                        <p class="font-bold p-4">+</p>
                        
                    </div>
                </a>
                @foreach ($decks as $deck)
                <a class="p-4 px-4 mb-4">
                    
                    <div class="border-4 {{ $deck->deck_format === 'standard' ? 'border-blue-500' : '' }} {{ $deck->deck_format === 'expanded' ? 'border-red-500' : '' }}
                        bg-custom-image max-w-xs rounded overflow-hidden shadow-lg text-white mb-1 p-4 h-64 w-48 relative">
                        
                    </div>
                    <p class="text-gray">{{ $deck->deck_name}} {{ $deck->card_amount}}/60</p>
                    <form action="{{ route('decks.update', $deck->id_deck) }}" method="get" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold mb-4 py-2 px-2 rounded">
                            <i class="fas fa-edit text-xl"></i>
                        </button>
                    </form>
                    <!--<a href="/update?id_deck={{$deck->id_deck}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded " id_deck="{{$deck->id_deck}}" >
                        Update
                    </a>-->
                    <!--<a class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" id="{{$deck->id_deck}}">Update</a>-->
                    <form action="{{ route('decks.delete', $deck->id_deck) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-900 text-white font-bold mb-4 py-2 px-2 rounded">
                            <i class="fas fa-trash text-xl"></i>
                        </button>
                    </form>
                </a>
                @endforeach
            </div>
    </div>
</div>