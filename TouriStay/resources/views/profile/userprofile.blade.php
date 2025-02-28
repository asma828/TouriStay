<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Profil Utilisateur</title>
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
                    <a href="#" class="text-gray-700 hover:text-blue-600 relative">
                        <i class="far fa-bell text-xl"></i>
                    </a>
                    {{-- <a href="" class="text-blue-600 hover:text-blue-700"> --}}
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
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-500 to-green-400 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Mon Profil</h1>
                    <p class="text-white text-lg">Gérez vos informations personnelles</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Profile Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex flex-col items-center">
                        <div class="relative">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-500">
                            @else
                                <img src="/api/placeholder/120/120" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover border-4 border-blue-500">
                            @endif
                            
                            <button type="button" onclick="document.getElementById('photo-upload-modal').classList.remove('hidden')" class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $user->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ ucfirst($user->role) }}</p>
                        <div class="w-full border-t border-gray-200 my-4"></div>
                        <div class="w-full">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-envelope text-blue-500 mr-3 w-5"></i>
                                <span class="text-gray-700">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center mb-3">
                                <i class="fas fa-calendar-alt text-blue-500 mr-3 w-5"></i>
                                <span class="text-gray-700">Membre depuis Jan 2024</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-star text-blue-500 mr-3 w-5"></i>
                                <span class="text-gray-700">Note moyenne: 4.8/5</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Links -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Menu Profil</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#informations" class="flex items-center py-2 px-3 bg-blue-50 text-blue-700 rounded-md font-medium">
                                <i class="fas fa-user-edit mr-3"></i>
                                <span>Informations personnelles</span>
                            </a>
                        </li>
                        <li>
                            <a href="#security" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-md transition duration-200">
                                <i class="fas fa-lock mr-3"></i>
                                <span>Sécurité</span>
                            </a>
                        </li>
                        <li>
                            <a href="#notifications" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-md transition duration-200">
                                <i class="fas fa-bell mr-3"></i>
                                <span>Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a href="#payment" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-md transition duration-200">
                                <i class="fas fa-credit-card mr-3"></i>
                                <span>Méthodes de paiement</span>
                            </a>
                        </li>
                        <li>
                            <a href="#dashboard" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-md transition duration-200">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Column - Profile Details -->
            <div class="lg:col-span-2">
                <!-- Personal Information -->
<div id="informations" class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-800">Informations personnelles</h3>
        <button id="editInfoBtn" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-pen mr-1"></i> Modifier
        </button>
    </div>

    <!-- View Mode -->
    <div id="infoViewMode">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h4 class="text-sm font-medium text-gray-500 mb-1">Nom complet</h4>
                <p class="text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500 mb-1">Email</h4>
                <p class="text-gray-800">{{ $user->email }}</p>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500 mb-1">Rôle</h4>
                <p class="text-gray-800">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ ucfirst($user->role) }}
                    </span>
                </p>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500 mb-1">Date d'inscription</h4>
                <p class="text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Edit Mode -->
    <div id="infoEditMode" class="hidden">
        <form action="{{ route('profile.userprofile.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                    <select id="role" name="role" disabled class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 focus:outline-none">
                        <option value="touriste" {{ $user->role == 'touriste' ? 'selected' : '' }}>Touriste</option>
                        <option value="proprietaire" {{ $user->role == 'proprietaire' ? 'selected' : '' }}>Propriétaire</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Le rôle ne peut être modifié que par un administrateur</p>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelInfoBtn" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-50 transition duration-300">Annuler</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">Enregistrer</button>
            </div>
        </form>
    </div>
</div>



                <!-- Notifications Settings -->
                <div id="notifications" class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Paramètres de notifications</h3>
                    
                    <form>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div>
                                    <h4 class="font-medium text-gray-800">Nouvelles réservations</h4>
                                    <p class="text-sm text-gray-600">Recevoir une notification lorsqu'une nouvelle demande de réservation est reçue</p>
                                </div>
                                <label class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only" checked>
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition transform translate-x-6"></div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div>
                                    <h4 class="font-medium text-gray-800">Confirmations de réservation</h4>
                                    <p class="text-sm text-gray-600">Recevoir une notification lorsqu'une réservation est confirmée</p>
                                </div>
                                <label class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only" checked>
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition transform translate-x-6"></div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div>
                                    <h4 class="font-medium text-gray-800">Nouvelles évaluations</h4>
                                    <p class="text-sm text-gray-600">Recevoir une notification lorsqu'un voyageur laisse une évaluation</p>
                                </div>
                                <label class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only" checked>
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition transform translate-x-6"></div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                <div>
                                    <h4 class="font-medium text-gray-800">Actualités et promotions</h4>
                                    <p class="text-sm text-gray-600">Recevoir des e-mails sur les nouvelles fonctionnalités et offres spéciales</p>
                                </div>
                                <label class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only">
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">Enregistrer les préférences</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Modal pour télécharger une photo -->
<div id="photo-upload-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Modifier votre photo de profil</h3>
            <button type="button" onclick="document.getElementById('photo-upload-modal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('profile.userprofile.photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
                    Choisir une photo
                </label>
                <input type="file" name="photo" id="photo" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md" required>
                <p class="text-xs text-gray-500 mt-1">Formats acceptés : JPG, PNG, GIF. Taille max : 2 Mo</p>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('photo-upload-modal').classList.add('hidden')" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-50 transition duration-300">
                    Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                    Enregistrer
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
        // Toggle edit mode for personal information
        document.getElementById('editInfoBtn').addEventListener('click', function() {
            document.getElementById('infoViewMode').classList.add('hidden');
            document.getElementById('infoEditMode').classList.remove('hidden');
        });

        document.getElementById('cancelInfoBtn').addEventListener('click', function() {
            document.getElementById('infoEditMode').classList.add('hidden');
            document.getElementById('infoViewMode').classList.remove('hidden');
        });


        // Smooth scrolling for in-page links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                    
                    // Update active state in menu
                    document.querySelectorAll('a[href^="#"]').forEach(link => {
                        link.classList.remove('bg-blue-50', 'text-blue-700');
                        link.classList.add('text-gray-700', 'hover:bg-gray-50', 'hover:text-blue-600');
                    });
                    
                    this.classList.remove('text-gray-700', 'hover:bg-gray-50', 'hover:text-blue-600');
                    this.classList.add('bg-blue-50', 'text-blue-700');
                }
            });
        });
    </script>
</body>
</html>
