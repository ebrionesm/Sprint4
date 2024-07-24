<div class="fixed bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="{{route("decks.main")}}"  class="text-white text-3xl font-semibold uppercase hover:text-gray-300"><img class="w-full object-contain"src="{{ asset('img/logo.png') }}" alt="Pokédeck Logo" class="w-24 h-auto mr-2"></a>
    </div>
    
    <nav class="text-white text-base font-semibold pt-3">
            
            <a href="/create" class=" flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="fas fa-plus mr-2"></i>Create deck</a>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="fas fa-envelope mr-2"></i>Contact</a>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"><i class="fas fa-user mr-2"></i> My profile</a>

    </nav>
</div>
