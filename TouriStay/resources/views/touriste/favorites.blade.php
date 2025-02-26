@extends('layouts.touriste')

@section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Mes hébergements favoris</h1>
            <p class="text-gray-600 mb-0">Retrouvez ici tous les hébergements que vous avez ajoutés à vos favoris</p>
        </div>

        <!-- Favorites Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Favorite 1 -->
            @forelse($annonces as $annonce)

            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    <img src="{{ asset('storage/' . explode(',', $annonce->images)[0]) }}" alt="{{ $annonce->titre }}" class="w-full h-56 object-cover">
                    <button class="absolute top-4 right-4 bg-white w-10 h-10 rounded-full flex items-center justify-center shadow-md">
                        <i class="fas fa-heart text-red-500 text-xl"></i>
                    </button>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $annonce->titre }}</h3>
                    <p class="text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>{{ $annonce->ville }}</p>
                    <p class="text-gray-600 mb-3"><i class="fas fa-bed mr-2 text-blue-500"></i>3 chambres · <i class="fas fa-bath mr-1 ml-1 text-blue-500"></i>2 salles de bain</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-green-600">{{ $annonce->prix }} €/nuit</span>
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">Voir détails</a>
                    </div>
                </div>
              
            </div>

            @empty
            <div class="col-span-4 py-8 text-center">
                <p class="text-gray-500 text-lg">Aucune favorite annonce disponible pour le moment.</p>
            </div>
        @endforelse
        </div>
    </div>


    @endsection
    <script>
        // Simple script to remove favorites (for demonstration)
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                const card = this.closest('.bg-white');
                card.classList.add('scale-0', 'opacity-0');
                setTimeout(() => {
                    card.remove();
                }, 300);
            });
        });
    </script>
</body>
</html>