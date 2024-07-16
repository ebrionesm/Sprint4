<div id="deck-list">
    <ul>
        @if($returnCards && count($returnCards) > 0)
            @foreach ($returnCards as $deckCard)
                <li>{{ $deckCard['card']->card_name }} (Cantidad: {{ $deckCard['quantity'] }})</li>
            @endforeach
        @else
            <li>No hay cartas en el mazo actual.</li>
        @endif
    </ul>
</div>
