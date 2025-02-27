<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4">
                <a href="#" class="text-2xl font-bold text-blue-400">TouriStay<span class="text-green-400">2030</span></a>
                <p class="text-gray-400 text-sm mt-1">Panneau d'administration</p>
            </div>
            <nav class="mt-5">
                <a href="#" class="flex items-center py-3 px-6 bg-gray-700 text-blue-400 border-l-4 border-blue-400">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-home mr-3"></i>
                    <span>Annonces</span>
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-users mr-3"></i>
                    <span>Utilisateurs</span>
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-flag mr-3"></i>
                    <span>Signalements</span>
                </a>
                <a href="#" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Paramètres</span>
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-4 bg-gray-900">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center text-gray-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Déconnexion</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <span class="text-gray-800 text-lg font-semibold">Dashboard Admin</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-700 focus:outline-none">
                                <img src="https://via.placeholder.com/40" alt="Admin Avatar" class="h-8 w-8 rounded-full object-cover">
                                <span class="ml-2">Admin</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Vue d'ensemble</h1>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3">
                                <i class="fas fa-user text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Utilisateurs inscrits</h3>
                                <p class="text-2xl font-bold text-gray-800">2,547</p>
                                <p class="text-green-500 text-sm"><i class="fas fa-arrow-up mr-1"></i>12% ce mois</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3">
                                <i class="fas fa-home text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Annonces actives</h3>
                                <p class="text-2xl font-bold text-gray-800">1,204</p>
                                <p class="text-green-500 text-sm"><i class="fas fa-arrow-up mr-1"></i>8% ce mois</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3">
                                <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Réservations</h3>
                                <p class="text-2xl font-bold text-gray-800">847</p>
                                <p class="text-green-500 text-sm"><i class="fas fa-arrow-up mr-1"></i>24% ce mois</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-red-100 p-3">
                                <i class="fas fa-flag text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Signalements</h3>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                                <p class="text-red-500 text-sm"><i class="fas fa-arrow-down mr-1"></i>3% ce mois</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Inscriptions mensuelles</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique des inscriptions" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Répartition des annonces par pays</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique de répartition" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                </div>
                
                <!-- Recent Listings -->
                <div class="bg-white rounded-lg shadow-md mb-8">
                    <div class="flex items-center justify-between p-6 border-b">
                        <h2 class="text-gray-800 text-lg font-semibold">Annonces récentes</h2>
                        <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Voir toutes</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ville</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propriétaire</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#1254</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Appartement moderne</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Casablanca</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ahmed K.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">75 €/nuit</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#1253</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Villa avec piscine</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Madrid</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Miguel S.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">150 €/nuit</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#1252</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Appartement centre-ville</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Lisbonne</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">João F.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">95 €/nuit</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#1251</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Maison traditionnelle</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rabat</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Youssef M.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">85 €/nuit</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Signalé
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Recent Reports -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between p-6 border-b">
                        <h2 class="text-gray-800 text-lg font-semibold">Signalements récents</h2>
                        <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Voir tous</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Annonce</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Raison</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Signalé par</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#R102</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Maison traditionnelle (#1251)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Photos trompeuses</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Carlos R.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">24 Fév 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-check"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-ban"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#R101</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Studio vue mer (#1245)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Contenu frauduleux</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Marie T.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">22 Fév 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-check"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-ban"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>