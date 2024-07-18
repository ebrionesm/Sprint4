
<div  >
    <div class="flex flex-wrap" id="card-container">
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