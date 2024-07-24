<div id="deck-list">
    <h2 class="text-xl font-bold mb-4">Current Deck List</h2>
    <table class="min-w-full bg-white">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Type</th>
                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Quantity</th>
            </tr>
        </thead>
        <tbody>
            @if($returnCards && count($returnCards) > 0)
                @foreach ($returnCards as $cardId => $cardData)
                    @if(isset($cardData['card']))
                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">{{ ucwords($cardData['card']->card_name) }}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{ ucfirst($cardData['card']->card_type) }}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$cardData['quantity']}}</td>
                        </tr>
                    @else
                        <li>Card data not available for ID: {{ $cardId }}</li>
                    @endif
                @endforeach
            @else
                <tr>
                    <td class="py-3 px-4 text-center" colspan="3">The deck is empty.</td>
                </tr>
            @endif
        </tbody>
    </table>
    </ul>
</div>