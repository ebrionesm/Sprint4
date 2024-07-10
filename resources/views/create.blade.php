<!DOCTYPE html>
<html>
<head>
    <title>Decks</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-md mx-auto mt-8">
        <form action="{{url('/')}}" method="GET" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M9.293 14.293a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L8 11.586l5.293-5.293a1 1 0 0 1 1.414 1.414l-6 6a1 1 0 0 1-1.414 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Deck
                </button>
            </div>
        </form>
    </div>
</body>
</html>
