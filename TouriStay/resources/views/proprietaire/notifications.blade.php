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
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mes notifications</h1>
        
        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
            @csrf
            <button type="submit" class="text-blue-600 hover:text-blue-800">
                Marquer tout comme lu
            </button>
        </form>
    </div>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($notifications->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($notifications as $notification)
                    <li class="p-4 hover:bg-gray-50 transition {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-800">{{ $notification->data['message'] }}</p>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->format('d/m/Y H:i') }}</p>
                                
                                @if(isset($notification->data['reservation_id']))
                                    <a href="" class="text-blue-600 hover:text-blue-800 text-sm mt-2 inline-block">
                                        Voir les détails de la réservation
                                    </a>
                                @endif
                            </div>
                            
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                        Marquer comme lu
                                    </button>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="p-6 text-center">
                <p class="text-gray-600">Vous n'avez aucune notification.</p>
            </div>
        @endif
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

</body>
</html>
