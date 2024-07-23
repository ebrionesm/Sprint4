<nav class="bg-gray-900 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{route("decks.main")}}" class="text-white text-lg font-bold">Pokédeck</a>
        <div class="flex items-center space-x-4 ml-auto hidden md:flex">
            <a href="#" class="text-white font-mono">Create deck</a>
            <a href="#" class="text-white font-mono">Contact</a>
            <a href="#" class="text-white font-mono"><i class="fas fa-user"></i></a>
        </div>
        <input type="checkbox" id="menu-toggle" class="menu-mobile">
        <label for="menu-toggle" class="md:hidden text-white cursor-pointer">
            ☰
        </label>
    </div>
    <div class=" menu-content md:hidden hidden">
        <a href="#" class="block text-white px-4 py-2">Create deck</a>
        <a href="#" class="block text-white px-4 py-2">Contact</a>
        <a href="#" class="block text-white px-4 py-2"><i class="fas fa-user"></i></a>
    </div>
</nav>
