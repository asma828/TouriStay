<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Suivi des Paiements</title>
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
        <a href="{{Route('admin.dashboard')}}" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-tachometer-alt mr-3"></i>
            <span>Tableau de bord</span>
        </a>
     
        <a href="{{Route('admin.paiement')}}" class="flex items-center py-3 px-6 bg-gray-700 text-blue-400 border-l-4 border-blue-400">
            <i class="fas fa-money-bill-wave mr-3"></i>
            <span>Paiements</span>
        </a>
        <a href="{{Route('admin.reservation')}}" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-calendar-check mr-3"></i>
            <span>Réservations</span>
        </a>
        <a href="" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-users mr-3"></i>
            <span>Utilisateurs</span>
        </a>
        <a href="" class="flex items-center py-3 px-6 text-gray-300 hover:bg-gray-700 hover:text-white">
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
                        <span class="text-gray-800 text-lg font-semibold">Suivi des Paiements</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-700 focus:outline-none">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Admin Avatar" class="h-8 w-8 rounded-full object-cover">
                                @else
                                    <img src="https://via.placeholder.com/40" alt="Admin Avatar" class="h-8 w-8 rounded-full object-cover">
                                @endif
                                <span class="ml-2">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Gestion des Paiements</h1>
                
                <!-- Filter and Search -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statut de paiement</label>
                            <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option>Tous les statuts</option>
                                <option>Payé</option>
                                <option>En attente</option>
                                <option>Remboursé</option>
                                <option>Échoué</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                            <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                            <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                            <input type="text" placeholder="ID, client, transaction..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">Appliquer les filtres</button>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3">
                                <i class="fas fa-money-bill-wave text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Montant total</h3>
                                <p class="text-2xl font-bold text-gray-800">256 840 €</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Paiements complétés</h3>
                                <p class="text-2xl font-bold text-gray-800">978</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">En attente</h3>
                                <p class="text-2xl font-bold text-gray-800">142</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-red-100 p-3">
                                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm font-medium">Paiements échoués</h3>
                                <p class="text-2xl font-bold text-gray-800">36</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Revenus mensuels (2025)</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique des revenus" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-gray-800 text-lg font-semibold mb-4">Méthodes de paiement</h2>
                        <div class="relative h-64">
                            <img src="/api/placeholder/600/250" alt="Graphique des méthodes de paiement" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-gray-800 text-lg font-semibold mb-4">Transactions récentes</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Trans.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8742</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sophie Martin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-visa text-blue-600 mr-2"></i> Visa
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">02/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">1 450 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8741</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Michel Dupont</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-paypal text-blue-800 mr-2"></i> PayPal
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">01/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">480 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8740</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Julien Moreau</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-mastercard text-orange-600 mr-2"></i> MasterCard
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">1 890 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8739</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laura Petit</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-apple-pay text-gray-900 mr-2"></i> Apple Pay
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">27/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">2 100 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8738</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Thomas Leroy</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-visa text-blue-600 mr-2"></i> Visa
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">26/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">760 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Remboursé</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- All Payments Table -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between p-6 border-b">
                        <h2 class="text-gray-800 text-lg font-semibold">Tous les paiements</h2>
                        <div class="flex space-x-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm">
                                <i class="fas fa-file-export mr-1"></i> Exporter
                            </button>
                            <button class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded text-sm">
                                <i class="fas fa-print mr-1"></i> Imprimer
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Trans.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Réserv.</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hébergement</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8742</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2584</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sophie Martin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Villa méditerranéenne</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">02/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-visa text-blue-600 mr-2"></i> Visa
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">1 450 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">145 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-file-invoice"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-sync-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8741</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2583</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Michel Dupont</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Appartement Centre-ville</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">01/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-paypal text-blue-800 mr-2"></i> PayPal
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">480 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">48 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-check-circle"></i></a>
                                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-times-circle"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8740</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2582</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Julien Moreau</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Chalet de montagne</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-mastercard text-orange-600 mr-2"></i> MasterCard
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">1 890 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">189 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-file-invoice"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-sync-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#P8739</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#B2581</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laura Petit</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Maison de plage</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">27/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <i class="fab fa-cc-apple-pay text-gray-900 mr-2"></i> Apple Pay
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">2 100 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">210 €</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-file-invoice"></i></a>
                                            <a href="#" class="text-green-600 hover:text-green-900"><i class="fas fa-sync-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>

                            </body>
                            </html>