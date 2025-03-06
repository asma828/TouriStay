<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Modifier l'annonce</title>
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
                    <i class="far fa-bell text-xl"></i>
                    <i class="far fa-user-circle text-xl"></i>
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

<!--disponibilité erreur handling-->
    @if ($errors->has('disponible_du') || $errors->has('disponible_au'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p>{{ $errors->first('disponible_du') }}</p>
        <p>{{ $errors->first('disponible_au') }}</p>
    </div>
@endif

    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-blue-500 to-green-400 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Modifier votre annonce</h1>
                    <p class="text-white text-lg">Mettez à jour les détails de votre hébergement</p>
                </div>
                <a href="{{ route('proprietaire.dashboard') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-md font-bold shadow-md transition duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Retour au tableau de bord
                </a>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form action="{{ route('annonces.update', $annonce->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce*</label>
                            <input type="text" name="titre" id="titre" required value="{{ $annonce->titre }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Appartement moderne proche du stade">
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
                            <textarea name="description" id="description" rows="6" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Décrivez votre hébergement en détail...">{{ $annonce->description }}</textarea>
                        </div>
                        
                        <!-- Ville -->
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville*</label>
                            <select name="ville" id="ville" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez une ville</option>
                                <option value="Casablanca" {{ $annonce->ville == 'Casablanca' ? 'selected' : '' }}>Casablanca</option>
                                <option value="Rabat" {{ $annonce->ville == 'Rabat' ? 'selected' : '' }}>Rabat</option>
                                <option value="Marrakech" {{ $annonce->ville == 'Marrakech' ? 'selected' : '' }}>Marrakech</option>
                                <option value="Tanger" {{ $annonce->ville == 'Tanger' ? 'selected' : '' }}>Tanger</option>
                                <option value="Fès" {{ $annonce->ville == 'Fès' ? 'selected' : '' }}>Fès</option>
                                <option value="Agadir" {{ $annonce->ville == 'Agadir' ? 'selected' : '' }}>Agadir</option>
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
                                <input type="number" name="prix" id="prix" required min="1" step="0.01" value="{{ $annonce->prix }}" class="w-full border border-gray-300 rounded-md pl-7 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 85">
                            </div>
                        </div>
                        
                        <!-- Équipements -->
                        <div>
                            <label for="equipements" class="block text-sm font-medium text-gray-700 mb-2">Équipements*</label>
                            @php
                                $equipements = json_decode($annonce->equipements, true) ?? [];
                            @endphp
                            <input type="hidden" name="equipements" value="">
                            <div class="grid grid-cols-2 gap-2 mb-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="wifi" value="Wifi" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('Wifi', $equipements) ? 'checked' : '' }}>
                                    <label for="wifi" class="ml-2 text-sm text-gray-700">Wifi</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="climatisation" value="Climatisation" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('Climatisation', $equipements) ? 'checked' : '' }}>
                                    <label for="climatisation" class="ml-2 text-sm text-gray-700">Climatisation</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="cuisine" value="Cuisine" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('Cuisine', $equipements) ? 'checked' : '' }}>
                                    <label for="cuisine" class="ml-2 text-sm text-gray-700">Cuisine</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="tv" value="TV" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('TV', $equipements) ? 'checked' : '' }}>
                                    <label for="tv" class="ml-2 text-sm text-gray-700">TV</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="parking" value="Parking" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('Parking', $equipements) ? 'checked' : '' }}>
                                    <label for="parking" class="ml-2 text-sm text-gray-700">Parking</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="equipements[]" id="piscine" value="Piscine" class="h-4 w-4 text-blue-600 rounded border-gray-300" {{ in_array('Piscine', $equipements) ? 'checked' : '' }}>
                                    <label for="piscine" class="ml-2 text-sm text-gray-700">Piscine</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dates de disponibilité -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="disponible_du" class="block text-sm font-medium text-gray-700 mb-2">Disponible du*</label>
                                <input type="date" name="disponible_du" id="disponible_du" required value="{{ $annonce->disponible_du->format('Y-m-d') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="disponible_au" class="block text-sm font-medium text-gray-700 mb-2">Disponible au*</label>
                                <input type="date" name="disponible_au" id="disponible_au" required value="{{ $annonce->disponible_au->format('Y-m-d') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload Section -->
                <div class="mt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photo de l'hébergement</label>
                    
                    <!-- Current Image Display -->
                    <div class="mb-4">
                        <p class="text-gray-700 mb-2">Image actuelle:</p>
                        <div class="border rounded-lg overflow-hidden w-64 h-48">
                            <img src="{{ asset('storage/' . $annonce->images) }}" alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-2">Glissez-déposez une nouvelle image ou</p>
                            <label for="image" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300 cursor-pointer">
                                Parcourir
                                <input type="file" name="image" id="image" accept="image/*" class="hidden">
                            </label>
                            <p class="text-sm text-gray-500 mt-2">Laisser vide pour conserver l'image actuelle</p>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <div class="flex items-center justify-center">
                                <img id="preview" src="#" alt="Aperçu de l'image" class="max-h-64 max-w-full">
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Format accepté: JPG, PNG. Taille maximale: 5MB</p>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('proprietaire.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-md font-medium transition duration-300">
                        Annuler
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-bold shadow-md transition duration-300">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
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

    <script>
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