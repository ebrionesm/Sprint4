<div id="deck-list">
    <ul>
        @if($returnCards && count($returnCards) > 0)
            @foreach ($returnCards as $cardId => $cardData)
                @if(isset($cardData['card']))
                    <li>{{ $cardData['card']->card_name }} {{$cardData['quantity']}}</li>
                @else
                    <li>Card data not available for ID: {{ $cardId }}</li>
                @endif
            @endforeach
        @else
            <li>The deck is empty.</li>
        @endif
    </ul>
</div>