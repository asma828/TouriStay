<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Mon profil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .tab-btn.active {
            border-bottom: 2px solid #2563eb;
            color: #2563eb;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
  <!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="{{ route('touriste.dashboard') }}" class="text-2xl font-bold text-blue-600">TouriStay<span class="text-green-500">2030</span></a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('touriste.favorites') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="far fa-heart text-xl"></i>
                </a>
                <a href="{{ route('touriste.profile') }}" class="text-gray-700 hover:text-blue-600">
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

    <div class="container mx-auto px-4 py-8">
        <!-- Profile Header -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 mb-4 md:mb-0 md:mr-6 flex-shrink-0">
                    <img src="https://via.placeholder.com/128x128" alt="Photo de profil" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Mohammed Amine</h1>
                    <p class="text-gray-600 mb-1"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Casablanca, Maroc</p>
                    <p class="text-gray-600 mb-3"><i class="far fa-calendar-alt mr-2 text-blue-500"></i>Membre depuis Février 2025</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                        <i class="far fa-edit mr-2"></i>Modifier le profil
                    </button>
                </div>
            </div>
        </div>

        <!-- Profile Tabs -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <div class="flex">
                    <button class="tab-btn active px-6 py-3 text-gray-700 font-medium transition" data-tab="profile">
                        <i class="fas fa-user mr-2"></i>Profil
                    </button>
                    <button class="tab-btn px-6 py-3 text-gray-700 font-medium transition" data-tab="reservations">
                        <i class="fas fa-calendar-check mr-2"></i>Réservations
                    </button>
                    <button class="tab-btn px-6 py-3 text-gray-700 font-medium transition" data-tab="settings">
                        <i class="fas fa-cog mr-2"></i>Paramètres
                    </button>
                </div>
            </div>

            <!-- Profile Tab Content -->
            <div id="profile" class="tab-content active p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informations personnelles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                            <div class="bg-gray-50 border border-gray-300 rounded-md p-3">Mohammed Amine</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                            <div class="bg-gray-50 border border-gray-300 rounded-md p-3">mohammed.amine@exemple.com</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <div class="bg-gray-50 border border-gray-300 rounded-md p-3">+212 6XX XXX XXX</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                            <div class="bg-gray-50 border border-gray-300 rounded-md p-3">Maroc</div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">À propos de moi</h2>
                    <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                        <p>Je suis un passionné de voyages et de football. J'ai hâte d'assister au Mondial 2030 et de découvrir les pays hôtes. J'espère trouver un hébergement confortable grâce à TouriStay 2030 !</p>
                    </div>
                </div>
            </div>

            <!-- Reservations Tab Content -->
            <div id="reservations" class="tab-content p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Mes réservations</h2>
                
                <div class="space-y-4">
                    <!-- Reservation Item 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-48 h-32 rounded-lg overflow-hidden">
                                <img src="https://via.placeholder.com/300x200" alt="Appartement Madrid" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col md:flex-row md:items-center justify-between mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Appartement centre-ville</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Confirmé
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-1"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Madrid, Espagne</p>
                                <p class="text-gray-600 mb-3"><i class="fas fa-calendar-alt mr-2 text-blue-500"></i>15 Juillet - 22 Juillet 2030</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-green-600">760 € (7 nuits)</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium transition">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reservation Item 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-48 h-32 rounded-lg overflow-hidden">
                                <img src="https://via.placeholder.com/300x200" alt="Maison Rabat" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col md:flex-row md:items-center justify-between mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">Maison traditionnelle</h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        En attente
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-1"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Rabat, Maroc</p>
                                <p class="text-gray-600 mb-3"><i class="fas fa-calendar-alt mr-2 text-blue-500"></i>10 Août - 15 Août 2030</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-green-600">425 € (5 nuits)</span>
                                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium transition">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab Content -->
            <div id="settings" class="tab-content p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Paramètres du compte</h2>
                
                <div class="space-y-6">
                    <!-- Personal Information Form -->
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Informations personnelles</h3>
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                                    <input type="text" id="fullname" name="fullname" value="Mohammed Amine" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                                    <input type="email" id="email" name="email" value="mohammed.amine@exemple.com" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" value="+212 6XX XXX XXX" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                                    <select id="country" name="country" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="maroc" selected>Maroc</option>
                                        <option value="espagne">Espagne</option>
                                        <option value="portugal">Portugal</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">À propos de moi</label>
                                <textarea id="bio" name="bio" rows="3" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">Je suis un passionné de voyages et de football. J'ai hâte d'assister au Mondial 2030 et de découvrir les pays hôtes. J'espère trouver un hébergement confortable grâce à TouriStay 2030 !</textarea>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Password Change Form -->
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Changer de mot de passe</h3>
                        <form>
                            <div class="space-y-4 mb-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                                    <input type="password" id="current_password" name="current_password" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                    <input type="password" id="new_password" name="new_password" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                                    Mettre à jour le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Account Preferences -->
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Préférences de notification</h3>
                        <form>
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="email_notif" name="email_notif" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="email_notif" class="ml-2 block text-sm text-gray-700">Recevoir des notifications par e-mail</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="promo_notif" name="promo_notif" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="promo_notif" class="ml-2 block text-sm text-gray-700">Recevoir des promotions et offres spéciales</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="booking_notif" name="booking_notif" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="booking_notif" class="ml-2 block text-sm text-gray-700">Notifications de réservation</label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                                    Enregistrer les préférences
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TouriStay 2030</h3>
                    <p class="text-gray-400">La plateforme idéale pour trouver votre hébergement durant le Mondial 2030.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens utiles</h3>
                    <ul class="space-y-2">
                        <li><a href="index.html" class="text-gray-400 hover:text-white transition">Accueil</a></li>
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
        // Tab switching functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and contents
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Add active class to clicked button and corresponding content
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>
</html>