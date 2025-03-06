@extends('layouts.touriste')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-green-400 rounded-xl shadow-lg p-8 mb-8">
        <h1 class="text-3xl font-bold text-white mb-4">Bienvenue sur TouriStay 2030</h1>
        <p class="text-white text-lg mb-6">Trouvez l'hébergement idéal pour le Mondial 2030 au Maroc, en Espagne et au Portugal</p>
        
        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <form action="{{ route('touriste.search') }}" method="GET" class="flex items-center gap-4">
                <div class="w-full flex gap-2">
                    <input type="text" name="city" placeholder="Ville" 
                           class="w-1/3 rounded-md border-gray-300 shadow-sm p-3 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="date" name="date_from" placeholder="Disponible à partir du" 
                           class="w-1/3 rounded-md border-gray-300 shadow-sm p-3 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="date" name="date_to" placeholder="Jusqu'au" 
                           class="w-1/3 rounded-md border-gray-300 shadow-sm p-3 border focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md transition duration-300">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Listings Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Hébergements disponibles</h2>
            <div class="flex items-center space-x-2">
                <span class="text-gray-600">Afficher:</span>
                <form id="perPageForm" action="{{ route('touriste.dashboard') }}" method="GET">
                    <select id="perPage" name="perPage" onchange="document.getElementById('perPageForm').submit()" class="rounded-md border-gray-300 shadow-sm p-2 border">
                        <option value="4" {{ request('perPage') == 4 ? 'selected' : '' }}>4</option>
                        <option value="10" {{ request('perPage') == 10 || !request('perPage') ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                    </select>
                </form>
                <span class="text-gray-600">par page</span>
            </div>
        </div>

        <!-- Listings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($annonces as $annonce)
                <!-- Listing Item -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('storage/' . explode(',', $annonce->images)[0]) }}" alt="{{ $annonce->titre }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-800">{{ $annonce->titre }}</h3>
                            <button class="favorite-btn text-gray-400 hover:text-yellow-500 transition-colors duration-300" 
                                    data-annonce-id="{{ $annonce->id }}"
                                    data-is-favorite="{{ $favorites->contains($annonce->id) ? 'true' : 'false' }}">
                                <i class="fa-heart {{ $favorites->contains($annonce->id) ? 'fas text-red-500' : 'far' }}"></i>
                            </button>
                        </div>
                        <p class="text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>{{ $annonce->ville }}</p>
                        <p class="text-gray-600 mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>Disponible: 
                            {{ \Carbon\Carbon::parse($annonce->disponible_du)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($annonce->disponible_au)->format('d/m/Y') }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-green-600">{{ $annonce->prix }} €/nuit</span>
                            <a href="{{ route('touriste.annonce.show', $annonce->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">Voir détails</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 py-8 text-center">
                    <p class="text-gray-500 text-lg">Aucune annonce disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $annonces->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>

    <!-- Featured Cities Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Destinations populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($popularCities as $city)
                <a href="{{ route('touriste.search', ['city' => $city['name']]) }}" class="relative rounded-lg overflow-hidden shadow-lg group h-64">
                    <img src="{{ asset('images/' . $city['image']) }}" alt="{{ $city['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                        <div class="p-5 text-white">
                            <h3 class="text-xl font-bold">{{ $city['name'] }}</h3>
                            <p>{{ $city['country'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle favorites
        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const annonceId = this.getAttribute('data-annonce-id');
                const isFavorite = this.getAttribute('data-is-favorite') === 'true';
                
                fetch('{{ route('touriste.toggle-favorite') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        annonce_id: annonceId,
                        is_favorite: isFavorite
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const heartIcon = this.querySelector('i');
                        heartIcon.classList.toggle('far');
                        heartIcon.classList.toggle('fas');
                        heartIcon.classList.toggle('text-red-500');
                        
                        this.setAttribute('data-is-favorite', isFavorite ? 'false' : 'true');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection