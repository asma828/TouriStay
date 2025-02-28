<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Tableau de Bord Propriétaire</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('proprietaire.dashboard') }}" class="text-2xl font-bold text-blue-600">TouriStay<span class="text-green-500">2030</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    {{-- <a href="{{ route('proprietaire.notifications') }}" class="text-gray-700 hover:text-blue-600 relative"> --}}
                        <i class="far fa-bell text-xl"></i>
                        {{-- <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span> --}}
                    {{-- </a> --}}
                    <a href="{{ route('profile.userprofile') }}" class="text-gray-700 hover:text-blue-600">
                        <i class="far fa-user-circle text-xl"></i>
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif

    <div class="container mx-auto px-4 py-8">
        <!-- Dashboard Header -->
        <div class="bg-gradient-to-r from-blue-500 to-green-400 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Tableau de Bord Propriétaire</h1>
                    <p class="text-white text-lg">Gérez vos annonces pour le Mondial 2030</p>
                </div>
                <a href="#" onclick="openAnnonceModal()" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-md font-bold shadow-md transition duration-300 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Ajouter une annonce
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-blue-100 p-3 mr-4">
                        <i class="fas fa-home text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Annonces actives</p>
                        <h3 class="text-2xl font-bold text-gray-800">4</h3>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Réservations confirmées</p>
                        <h3 class="text-2xl font-bold text-gray-800">12</h3>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-yellow-100 p-3 mr-4">
                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Note moyenne</p>
                        <h3 class="text-2xl font-bold text-gray-800">4.8/5</h3>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full bg-purple-100 p-3 mr-4">
                        <i class="fas fa-euro-sign text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500">Revenus estimés</p>
                        <h3 class="text-2xl font-bold text-gray-800">3 450 €</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Listings Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Mes Hébergements</h2>
                <div class="flex items-center">
                    <input type="text" placeholder="Rechercher une annonce..." class="border border-gray-300 rounded-md p-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <select class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all">Tous les statuts</option>
                        <option value="active">Actifs</option>
                        <option value="inactive">Inactifs</option>
                    </select>
                </div>
            </div>

            <!-- Listings Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hébergement</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Localisation</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilité</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Listing  -->
                        <tr>
                            @forelse($annonces as $annonce)

                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . explode(',', $annonce->images)[0]) }}" alt="Appartement" class="h-16 w-24 object-cover rounded-md mr-3">
                                    <span class="font-medium text-gray-800">{{ $annonce->titre }}</span>
                                </div>
                            </td>  
                            <td class="py-4 px-4 text-gray-600">{{ $annonce->ville }}, Maroc</td>
                            <td class="py-4 px-4 text-gray-600">{{ $annonce->prix }} €/nuit</td>
                            <td class="py-4 px-4 text-gray-600">Juin - Août 2030</td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('annonces.edit', $annonce->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('annonces.show', $annonce->id) }}" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <div class="col-span-4 py-8 text-center">
                            <p class="text-gray-500 text-lg">Aucune annonce disponible pour le moment.</p>
                        </div>
                    @endforelse
                    </tbody>
                </table>
             
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <div class="text-gray-600">Affichant 1 à 4 sur 4 annonces</div>
                <nav class="inline-flex rounded-md shadow-sm">
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 text-sm font-medium rounded-l-md text-gray-700 hover:bg-gray-50">
                        Précédent
                    </a>
                    <a href="#" class="py-2 px-4 bg-blue-600 border border-blue-600 text-sm font-medium text-white">
                        1
                    </a>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 hover:bg-gray-50">
                        Suivant
                    </a>
                </nav>
            </div>
        </div>

        <!-- Reservation Requests Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dernières demandes de réservation</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Request 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-bold text-gray-800">Appartement moderne</h3>
                            <p class="text-gray-600 text-sm">Casablanca, Maroc</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-user mr-2 text-blue-500"></i>Pierre Dupont</p>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-calendar-alt mr-2 text-blue-500"></i>15 juin - 22 juin 2030 (7 nuits)</p>
                        <p class="text-gray-600 text-sm"><i class="fas fa-euro-sign mr-2 text-blue-500"></i>525 € (75 €/nuit)</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex-1">Accepter</button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex-1">Refuser</button>
                    </div>
                </div>
                
                <!-- Request 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-bold text-gray-800">Maison traditionnelle</h3>
                            <p class="text-gray-600 text-sm">Rabat, Maroc</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-user mr-2 text-blue-500"></i>Marie Lambert</p>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-calendar-alt mr-2 text-blue-500"></i>10 juillet - 20 juillet 2030 (10 nuits)</p>
                        <p class="text-gray-600 text-sm"><i class="fas fa-euro-sign mr-2 text-blue-500"></i>850 € (85 €/nuit)</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex-1">Accepter</button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex-1">Refuser</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Accès rapides</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="#" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                    <div class="rounded-full bg-blue-100 p-3 mr-3">
                        <i class="fas fa-plus text-blue-600"></i>
                    </div>
                    <span class="text-gray-700">Créer une annonce</span>
                </a>
                <a href="#" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                    <div class="rounded-full bg-green-100 p-3 mr-3">
                        <i class="fas fa-calendar-alt text-green-600"></i>
                    </div>
                    <span class="text-gray-700">Gérer mes disponibilités</span>
                </a>
                <a href="#" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                    <div class="rounded-full bg-purple-100 p-3 mr-3">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                    <span class="text-gray-700">Voir mes statistiques</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TouriStay 2030</h3>
                    <p class="text-gray-400">La plateforme idéale pour proposer votre hébergement durant le Mondial 2030.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens utiles</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Comment ça marche</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Nous contacter</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <span class="text-gray-400">contact@touristay2030.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-blue-400"></i>
                            <span class="text-gray-400">+212 5XX XXX XXX</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 TouriStay 2030. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

<!-- Modal Ajouter une annonce -->
<div id="annonceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden overflow-y-auto">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-r from-blue-500 to-green-400 p-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Ajouter une annonce</h2>
                <button onclick="closeAnnonceModal()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce*</label>
                            <input type="text" name="titre" id="titre" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Appartement moderne proche du stade">
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
                            <textarea name="description" id="description" rows="6" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Décrivez votre hébergement en détail..."></textarea>
                        </div>
                        
                        <!-- Ville -->
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville*</label>
                            <select name="ville" id="ville" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez une ville</option>
                                <option value="Casablanca">Casablanca</option>
                                <option value="Rabat">Rabat</option>
                                <option value="Marrakech">Marrakech</option>
                                <option value="Tanger">Tanger</option>
                                <option value="Fès">Fès</option>
                                <option value="Agadir">Agadir</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Prix -->
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">Prix par nuit (€)*</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                                <input type="number" name="prix" id="prix" required min="1" step="0.01" class="w-full border border-gray-300 rounded-md pl-7 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 85">
                            </div>
                        </div>
                        
                        <!-- Équipements -->
                        <div>
                            <label for="equipements" class="block text-sm font-medium text-gray-700 mb-2">Équipements*</label>
                            <input type="hidden" name="equipements" value="">
                            <div class="grid grid-cols-2 gap-2 mb-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="wifi" value="Wifi" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="wifi" class="ml-2 text-sm text-gray-700">Wifi</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="climatisation" value="Climatisation" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="climatisation" class="ml-2 text-sm text-gray-700">Climatisation</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="cuisine" value="Cuisine" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="cuisine" class="ml-2 text-sm text-gray-700">Cuisine</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="tv" value="TV" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="tv" class="ml-2 text-sm text-gray-700">TV</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="parking" value="Parking" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="parking" class="ml-2 text-sm text-gray-700">Parking</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="piscine" value="Piscine" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                    <label for="piscine" class="ml-2 text-sm text-gray-700">Piscine</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dates de disponibilité -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="disponible_du" class="block text-sm font-medium text-gray-700 mb-2">Disponible du*</label>
                                <input type="date" name="disponible_du" id="disponible_du" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="disponible_au" class="block text-sm font-medium text-gray-700 mb-2">Disponible au*</label>
                                <input type="date" name="disponible_au" id="disponible_au" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload Section -->
                <div class="mt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photo de l'hébergement*</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">Glissez-déposez une image ou</p>
                            <label for="image" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300 cursor-pointer">
                                Parcourir
                                <input type="file" name="image" id="image" accept="image/*" required class="hidden">
                            </label>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <div class="flex items-center justify-center">
                                <img id="preview" src="#" alt="Aperçu de l'image" class="max-h-64 max-w-full">
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Format accepté: JPG, PNG. Taille maximale: 5MB</p>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-bold shadow-md transition duration-300">
                        <i class="fas fa-plus mr-2"></i> Publier l'annonce
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        // Simple script to toggle favorites (for demonstration)
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                this.classList.toggle('far');
                this.classList.toggle('fas');
                this.classList.toggle('text-red-500');
            });
        });

// Fonctions pour la modal d'ajout d'annonce
function openAnnonceModal() {
    document.getElementById('annonceModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Empêche le défilement du body
}

function closeAnnonceModal() {
    document.getElementById('annonceModal').classList.add('hidden');
    document.body.style.overflow = 'auto'; // Réactive le défilement du body
}

// Script pour prévisualiser l'image sélectionnée
document.getElementById('image').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview').src = event.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

// Script pour vérifier que la date de fin est après la date de début
document.getElementById('disponible_au').addEventListener('change', function() {
    var dateDebut = document.getElementById('disponible_du').value;
    var dateFin = this.value;
    
    if (dateDebut && dateFin && new Date(dateFin) <= new Date(dateDebut)) {
        alert('La date de fin doit être postérieure à la date de début.');
        this.value = '';
    }
});

    </script>
</body>
</html>