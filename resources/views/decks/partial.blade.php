
<div  >
    <div class="flex flex-wrap" id="card-container">
        @foreach ($cards as $card)
            <div class="p-4 w-1/7 px-4 mb-2" >
                <div class="max-w-xs bg-custom-image rounded overflow-hidden shadow-lg bg-blue-500 text-white p-4 h-64 w-48 relative">
                    
                </div>
                <p class="font-bold">{{ ucwords($card->card_name) }}</p>
                <p>{{ ucfirst($card->card_type) }}</p>
                <button class="add-btn inline-block mt-2 bg-green-500 hover:bg-green-700 text-white font-bold p-2 rounded" card-id="{{$card->id_card}}"><i class="fas fa-plus"></i></button>
                <button class="delete-btn inline-block mt-2 bg-red-500 hover:bg-red-700 text-white font-bold p-2 rounded" card-id="{{$card->id_card}}"><i class="fas fa-minus"></i></button>
            </div>
            
        @endforeach
    </div>
    
</div>